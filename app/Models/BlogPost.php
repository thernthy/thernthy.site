<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = ['title', 'content', 'author', 'slug', 'images', 'video_url'];

    // Automatically generate slug on creating or updating if not provided
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title, '-');
            }
        });
    }

    protected $casts = [
        'images' => 'array',
    ];
}
