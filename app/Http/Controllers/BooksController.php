<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
    public function store()
    {
        $book = Book::create(request()->validate(Book::$validation));
        return redirect($book->path());
    }

    public function update(Book $book)
    {
        $book->update(request()->validate(Book::$validation));
        return redirect($book->path());
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }
}
