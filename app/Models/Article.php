<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * MODEL ARTICLE
 * Model ini mewakili tabel 'articles' di database.
 */
class Article extends Model
{
    use HasFactory;

    // Kolom-kolom yang diizinkan untuk diisi secara langsung (Mass Assignment)
    protected $fillable = [
        'title',
        'slug',
        'category',
        'secondary_tag',
        'author_name',
        'author_avatar',
        'author_role',
        'date',
        'excerpt',
        'content',
        'image'
    ];

    // Konversi tipe data otomatis (Casting)
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * ACCESSOR: Menghasilkan format waktu relatif (misal: "2 jam lalu")
     */
    public function getTimeAgoAttribute(): string
    {
        $timestamp = $this->created_at ?? ($this->date ? Carbon::parse($this->date) : now());
        return Carbon::parse($timestamp)->locale('id')->diffForHumans();
    }

    /**
     * ACCESSOR: Menghasilkan format tanggal yang rapi (misal: "05 Sep 2026, 12:00")
     */
    public function getFormattedDateAttribute(): string
    {
        $timestamp = $this->created_at ?? ($this->date ? Carbon::parse($this->date) : now());
        return Carbon::parse($timestamp)->locale('id')->translatedFormat('d M Y, H:i');
    }

    /**
     * MODEL EVENT (BOOT)
     * Logika otomatis sebelum data disimpan ke database.
     */
    protected static function boot()
    {
        parent::boot();

        // Sebelum data baru dibuat (Creating)
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

        // Sebelum data diperbarui (Updating)
        static::updating(function ($article) {
            if ($article->isDirty('title') && empty($article->slug)) {
                $article->slug = Str::slug($article->title) . '-' . time();
            }
        });
    }
}
