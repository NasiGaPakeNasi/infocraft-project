<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Kolom-kolom yang boleh diisi secara massal (saat membuat/mengupdate)
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'image',
    ];

    // Definisikan relasi: Satu Post dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class); // Post ini milik User
    }

    // Definisikan relasi: Satu Post punya banyak Comment
    public function comments()
    {
        return $this->hasMany(Comment::class); // Post ini punya banyak Comment
    }
}