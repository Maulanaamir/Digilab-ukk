<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class HomeController extends Controller
{
    // FUNGSI UNTUK HALAMAN DEPAN (WELCOME)
    public function index(Request $request)
    {
        // Fitur tendang Atmin 😹: Kalau admin udah login, langsung lempar ke dashboard
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        }

        //  Ambil data semua kategori, urutkan sesuai abjad
        $categories = Category::orderBy('name', 'ASC')->get(); 
        
        //  Siapkan query buku (Tanpa batasan stok, jadi stok 0 tetap tampil)
        $query = Book::query(); 

        //  Filter berdasarkan kategori jika user ngeklik kapsul kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        //  Fitur Search Bar (Nyari berdasarkan Judul atau Penulis)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                  ->orWhere('author', 'LIKE', '%' . $search . '%');
            });
        }

        //  Eksekusi pengambilan data (Ambil yang terbaru, batasi 24 buku biar rapi)
        $books = $query->latest()->take(24)->get();

        //  Kirim data ke welcome.blade.php
        return view('welcome', compact('categories', 'books'));
    }

    // FUNGSI UNTUK HALAMAN DETAIL BUKU
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('book-detail', compact('book'));
    }
}