<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $guarded = [];
    
    public static $validation = [
        'title' => 'required',
        'author' => 'required',
    ];

    public function path()
    {
        return '/books/'. $this->id;
    }
}
