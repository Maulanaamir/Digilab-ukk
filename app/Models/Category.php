<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function books()
    {
        return $this->hashMany(book::class);
    }
    // Relasi ke table bbuku one to many, satu kategori bisa memiliki banyak buku.
}
