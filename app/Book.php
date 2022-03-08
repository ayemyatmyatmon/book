<?php

namespace App;

use App\Writer;
use App\BookType;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $guarded = [];

    public function book_type()
    {
        return $this->belongsTo(BookType::class);
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }

}
