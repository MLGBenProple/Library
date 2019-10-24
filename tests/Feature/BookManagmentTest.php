<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookManagmentTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    /** @test */
    public function a_book_can_be_added_to_a_library()
    {

        $response = $this->post('/books',[
            'title' => 'Cool Book Title',
            'author' => 'Ben',
        ]);

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_title_is_required()
    {
        $responce = $this->post('/books',[
            'title' => '',
            'author' => 'Ben',
        ]);

        $responce->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_author_is_required()
    {
        $responce = $this->post('/books',[
            'title' => 'Cool Book Title',
            'author' => '',
        ]);

        $responce->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        
        $book = Book::create([
            'title' => 'Cool Book Title',
            'author' => 'Ben',
        ]);

        $response = $this->patch($book->path(), [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        $response->assertRedirect($book->fresh()->path());
    }

    /** @test */
    public function a_book_can_be_deleted()
    {

        $book = Book::create([
            'title' => 'Cool Book Title',
            'author' => 'Ben',
        ]);

        $response = $this->delete($book->path());

        $this->assertCount('0', Book::all());
        $response->assertRedirect('/books');
    }
}
