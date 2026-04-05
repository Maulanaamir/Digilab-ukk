<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Jika admin mengetik sesuatu di kotak search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('author', 'LIKE', '%'.$search.'%');
            });
        }

        // Ambil data, batasi 10 per halaman.
        // withQueryString() WAJIB ada biar pas klik halaman 2, pencariannya gak hilang!
        $book = $query->latest()->paginate(10)->withQueryString();

        return view('books.index', compact('book'));
    }

    /**
     * Menyimpan data buku baru ke database beserta gambarnya.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'published_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y') + 1),
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'storage/app/public/books'
            $imagePath = $request->file('image')->store('books', 'public');
            // Masukkan path gambar ke dalam array data yang akan disimpan
            $validatedData['image'] = $imagePath;
        }

        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Buku baru berhasil ditambahkan!');
    }

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
     * Memperbarui data buku dan mengganti gambar lama jika ada yang baru.
     */
    public function update(Request $request, Book $book)
    {
        // 1. Validasi inputan
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'published_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y') + 1),
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }

            $imagePath = $request->file('image')->store('books', 'public');
            $validatedData['image'] = $imagePath;
        }

        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku dari database beserta file gambarnya.
     */
    public function destroy(Book $book)
    {
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku beserta gambarnya berhasil dihapus!');
    }
}
