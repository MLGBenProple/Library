<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookReservationTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    /** @test */
    public function a_book_can_be_added_to_a_library()
    {
        $this->withoutExceptionHandling();

        $this->post('/books',[
            'title' => 'Cool Book Title',
            'author' => 'Ben',
        ])->assertOk();
        $this->assertCount(1, Book::all());
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
        $this->withoutExceptionHandling();
        
        $book = Book::create([
            'title' => 'Cool Book Title',
            'author' => 'Ben',
        ]);

        $this->patch('/books/'.$book->id, [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);
    }
}
