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


    // Relasi: Satu Post punya banyak Comment
    // // Ganti fungsi comments() yang lama dengan yang ini
public function comments()
{
    // Ambil komentar yang merupakan komentar utama (bukan balasan)
    return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
}

public function categories()
{
    return $this->belongsToMany(Category::class);
}

}