<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan halaman Split Layout (Tabel Kiri, Form Kanan)
     */
    public function index()
    {
        $categories = Category::latest()->get();
        // Kalau halaman dibuka normal (bukan mode edit), kirim 'categoryToEdit' sebagai null
        $categoryToEdit = null;

        return view('categories.index', compact('categories', 'categoryToEdit'));
    }

    /**
     * Menyimpan kategori baru ke database
     */
    public function store(Request $request)
    {
        // Kita pastikan namanya wajib diisi, maksimal 255 huruf, dan nggak boleh ada kategori kembar (unique)
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            // Pesan error custom biar lebih ramah dibaca admin
            'name.required' => 'Nama kategori tidak boleh kosong!',
            'name.unique' => 'Kategori ini sudah ada di database!',
        ]);

        // 2. Simpan ke database
        Category::create([
            'name' => $request->name,
        ]);

        // 3. Kembalikan ke halaman index dengan pesan sukses (warna hijau)
        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit kategori (kalau admin klik tombol biru)
     */
    public function edit(Category $category)
    {
        $categories = Category::latest()->get();
        // Kalau halaman dibuka dalam mode edit, kirim data kategori yang mau diedit
        $categoryToEdit = $category;

        return view('categories.index', compact('categories', 'categoryToEdit'));
    }

    /**
     * Menyimpan perubahan edit kategori
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            // Validasi unik, tapi abaikan ID kategori yang sedang diedit ini
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Nama kategori berhasil diperbarui!');
    }

    /**
     * Menghapus kategori dari database
     */
    public function destroy(Category $category)
    {

        if ($category->books()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Gagal! Kategori ini sedang digunakan oleh beberapa buku.');
        }

        // Kalau aman (nggak ada buku yang pakai), baru kita hapus
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
