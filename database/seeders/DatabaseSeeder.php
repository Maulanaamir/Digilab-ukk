<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Bikin Akun Admin (Biar kamu bisa login sebagai admin)
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@perpus.com',
            'password' => bcrypt('password'), // Passwordnya: password
            'role' => 'admin',
        ]);

        // 2. Bikin Akun Siswa (Biar kamu bisa ngetes fitur peminjaman)
        User::create([
            'name' => 'Deswita Maharani',
            'email' => 'siswa@perpus.com',
            'password' => bcrypt('password'), // Passwordnya: password
            'role' => 'siswa',
            'id_member' => '001122',
        ]);

        // 3. Bikin Kategori Buku
        $kategoriFiksi = Category::create(['name' => 'Novel & Fiksi']);
        $kategoriPelajaran = Category::create(['name' => 'Buku Pelajaran']);

        // 4. Bikin Data Buku
        Book::create([
            'title' => 'Mastering Laravel 12',
            'author' => 'Ahmad Maulana',
            'published_year' => 2026,
            'stock' => 10,
            'category_id' => $kategoriPelajaran->id, // Nyambung ke ID kategori pelajaran
        ]);

        Book::create([
            'title' => 'Laskar Pelangi',
            'author' => 'Andrea Hirata',
            'published_year' => 2005,
            'stock' => 5,
            'category_id' => $kategoriFiksi->id, // Nyambung ke ID kategori fiksi
        ]);
    }
}
