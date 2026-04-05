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
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@perpus.com',
            'password' => bcrypt('password'), // Passwordnya: password
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Deswita Maharani',
            'email' => 'siswa@perpus.com',
            'password' => bcrypt('password'), 
            'role' => 'siswa',
            'id_member' => '001122',
        ]);

        $kategoriFiksi = Category::create(['name' => 'Novel & Fiksi']);
        $kategoriPelajaran = Category::create(['name' => 'Pemrograman']);
        $kategoriPelajaran = Category::create(['name' => 'Romance']);
        $kategoriPelajaran = Category::create(['name' => 'Science']);
        
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
            'category_id' => $kategoriFiksi->id, 
        ]);
    }
}
