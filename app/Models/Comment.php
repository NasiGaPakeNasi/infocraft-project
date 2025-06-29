<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * INI BAGIAN PENTING 1:
     * Mendefinisikan kolom mana yang boleh diisi dari form.
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'body',
    ];

    /**
     * INI BAGIAN PENTING 2:
     * Menjelaskan hubungan ke tabel User. Tanpa ini, $comment->user akan error.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * INI BAGIAN PENTING 3:
     * Menjelaskan hubungan ke tabel Post.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

/**
 * Relasi untuk mendapatkan semua balasan (anak) dari sebuah komentar.
 */
public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id')->latest();
}

/**
 * Relasi untuk mendapatkan induk dari sebuah balasan.
 */
public function parent()
{
    return $this->belongsTo(Comment::class, 'parent_id');
}

}