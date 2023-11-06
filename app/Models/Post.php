<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    const POST_IMAGE_URL = 'https://api.unsplash.com/photos/';


    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
