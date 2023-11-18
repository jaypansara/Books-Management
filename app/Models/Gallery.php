<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    public $uploadDirectory = '/storage/books/';
    public const type = 1;
    protected $guarded = [];
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) =>$this->uploadDirectory.$image,

        );
    }
}
