<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Waktu relatif: "2 jam lalu", "baru saja", dst.
     */
    public function getTimeAgoAttribute(): string
    {
        $timestamp = $this->created_at ?? ($this->date ? Carbon::parse($this->date) : now());
        return Carbon::parse($timestamp)->locale('id')->diffForHumans();
    }

    /**
     * Tanggal format panjang: "5 Sep 2026, 12:04"
     */
    public function getFormattedDateAttribute(): string
    {
        $timestamp = $this->created_at ?? ($this->date ? Carbon::parse($this->date) : now());
        return Carbon::parse($timestamp)->locale('id')->translatedFormat('d M Y, H:i');
    }

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
