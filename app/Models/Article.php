<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'secondary_tag',
        'author_name',
        'author_avatar',
        'author_role',
        'date',
        'read_time',
        'excerpt',
        'content',
        'image',
        'likes'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title) . '-' . time();
            }
            if (empty($article->date)) {
                $article->date = now()->format('M d, Y');
            }
            if (empty($article->author_avatar)) {
                $article->author_avatar = 'https://i.pravatar.cc/100?img=' . rand(1, 20);
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title') && empty($article->slug)) {
                $article->slug = Str::slug($article->title) . '-' . time();
            }
        });
    }
}
