<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku.
     */
    public function index()
    {
        // Eager loading 'category' agar query database lebih ringan dan cepat
        $books = Book::with('category')->latest()->get();
        return view('books.index', compact('books'));
    }

    /**
     * Menampilkan form untuk menambah buku baru.
     */
    public function create()
    {
        // Ambil semua data kategori untuk ditampilkan di dropdown (select) form
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Menyimpan data buku baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan agar tidak ada data kosong atau salah tipe
        $validatedData = $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:100',
            'published_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'stock'          => 'required|integer|min:0',
            'category_id'    => 'required|exists:categories,id',
        ]);

        // 2. Simpan ke database
        Book::create($validatedData);

        // 3. Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu buku.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Menampilkan form untuk mengedit buku.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Memperbarui data buku di database.
     */
    public function update(Request $request, Book $book)
    {
        // 1. Validasi inputan sama seperti store
        $validatedData = $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:100',
            'published_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'stock'          => 'required|integer|min:0',
            'category_id'    => 'required|exists:categories,id',
        ]);

        // 2. Update data ke database
        $book->update($validatedData);

        // 3. Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku dari database.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}