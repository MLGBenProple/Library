<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];
    
    public static $validation = [
        'title' => 'required',
        'author' => 'required',
    ];
}
