<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function booksAuthor()
    {
        return $this->belongsTo('App\Author', 'author_id', 'id');
    }
}
