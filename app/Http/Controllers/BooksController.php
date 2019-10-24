<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
    public function store()
    {
        Book::create(request()->validate(Book::$validation));
    }

    public function update(Book $book)
    {
        $book->update(request()->validate(Book::$validation));
    }
}
