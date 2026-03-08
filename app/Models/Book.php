<?php

namespace App\Models;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'published_year',
        'stock',
        'category_id',
    ];


    // relasi ke tabel category (belongs to)
    // setiap buku pasti masuk ke dalam SATU category 

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    // relasi ke tabel peminjaman (hashMany)
    // satu bukuy bisa di pinjam berkali kali (punya banyak riwayat peminjaman)
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
