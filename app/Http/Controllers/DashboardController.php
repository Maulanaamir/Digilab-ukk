<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung statistik untuk kotak atas
        $currentlyBorrowed = Loan::where('status', 'borrowed')->count();
        $returnedBooks = Loan::where('status', 'returned')->count();
        $totalBooks = Book::sum('stock'); // Atau Book::count() jika ingin menghitung judul bukunya saja

        // Mengambil 5 aktivitas terbaru untuk tabel
        $recentActivities = Loan::with(['user', 'book'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'currentlyBorrowed', 
            'returnedBooks', 
            'totalBooks', 
            'recentActivities'
        ));
    }
}