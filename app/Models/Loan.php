<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',

    ];

    // relasi ke tabel penbgguna (belongs to)
    //satu peminjaman pastiu milik satu useer

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relasi ke tabel buku
    // satu peminjaman pasti meminjam satu buku sepesifik

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
