<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // <-- Tambahan wajib untuk fitur user login

class LoanController extends Controller
{
    // admin

    public function index()
    {
        // Ambil data peminjaman dari model Loan
        $loans = Loan::with(['user', 'book'])->latest()->get();
        
        // Ambil siswa dan buku yang stoknya > 0
        $members = User::where('role', 'siswa')->orderBy('name', 'ASC')->get();
        $books = Book::where('stock', '>', 0)->orderBy('title', 'ASC')->get();

        return view('loans.index', compact('loans', 'members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < 1) {
            return back()->with('error', 'Maaf, stok buku ini sedang kosong!');
        }

        // Catat di tabel loans
        Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => Carbon::now()->toDateString(), // Otomatis hari ini
            'return_date' => null, // Masih kosong karena belum dikembalikan
            'status' => 'borrowed', // Sesuai enum di migration
        ]);

        // Kurangi stok buku
        $book->decrement('stock');

        return redirect()->route('loans.index')->with('success', 'Peminjaman buku berhasil dicatat!');
    }

    public function update(Request $request, string $id)
    {
        // Tombol "Selesaikan Peminjaman" akan memicu fungsi ini
        $loan = Loan::findOrFail($id);

        if ($loan->status === 'borrowed') {
            $loan->status = 'returned';
            $loan->return_date = Carbon::now()->toDateString(); // Catat tanggal hari ini sebagai tanggal kembali
            $loan->save();

            // Kembalikan stok buku +1
            $loan->book->increment('stock');

            return redirect()->route('loans.index')->with('success', 'Buku telah dikembalikan dan stok diperbarui!');
        }

        return redirect()->route('loans.index')->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
    }

    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);

        // Kalau dihapus saat masih 'borrowed', kembalikan stoknya biar tidak bug
        if ($loan->status === 'borrowed') {
            $loan->book->increment('stock');
        }

        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Data peminjaman berhasil dihapus!');
    }



    public function borrowBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();

        // Cek Stok (Pencegahan kehabisan)
        if ($book->stock <= 0) {
            return back()->with('error', 'Oops! Buku ini baru saja habis dipinjam orang lain.');
        }

        // Cek Dobel Pinjam (Cegah siswa pinjam buku yang sama kalau belum dibalikin)
        $alreadyBorrowed = Loan::where('user_id', $user->id)
                               ->where('book_id', $book->id)
                               ->where('status', 'borrowed')
                               ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Kamu tidak bisa meminjam buku ini karena kamu belum mengembalikannya.');
        }

        // --- MULAI PROSES PINJAM (Murni Eloquent) ---

        // A. Kurangi stok buku
        $book->decrement('stock'); 

        // B. Buat riwayat peminjaman baru
        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => Carbon::now()->toDateString(),
            'return_date' => null,
            'status' => 'borrowed',
        ]);

        // C. Berhasil! Lempar ke halaman buku pinjamanku
        return redirect()->route('my.books')->with('success', 'Buku berhasil dipinjam! Selamat membaca.');
    }

    // 2. Fungsi Menampilkan Halaman "Buku Pinjamanku"
    public function myBooks()
    {
        // Ambil riwayat buku yang sedang dipinjam oleh user yang sedang login
        $loans = Loan::with('book')
                     ->where('user_id', Auth::id())
                     ->where('status', 'borrowed')
                     ->latest()
                     ->get();

        return view('my-books', compact('loans'));
    }
}