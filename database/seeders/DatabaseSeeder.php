<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. DATA USERS (Admin & Siswa) - Tanpa id_member
        // ==========================================
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@perpus.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Deswita Maharani',
            'email' => 'siswa@perpus.com',
            'password' => bcrypt('password'), 
            'role' => 'siswa',
        ]);

        User::create([
            'name' => 'Siswa Teladan',
            'email' => 'teladan@perpus.com',
            'password' => bcrypt('password'), 
            'role' => 'siswa',
        ]);

        // ==========================================
        // 2. DATA KATEGORI (10 Kategori Berbeda)
        // ==========================================
        $c = [];
        $categories = [
            'Pemrograman', 'Novel & Fiksi', 'Romance', 'Science & Tech', 
            'Bisnis', 'Sejarah', 'Komik & Manga', 'Biografi', 'Horor', 'Agama'
        ];

        foreach ($categories as $cat) {
            $c[$cat] = Category::create(['name' => $cat]);
        }

        // ==========================================
        // 3. DATA BUKU (Variatif & Banyak)
        // ==========================================
        $books = [
            // Pemrograman
            ['title' => 'Mastering Laravel 12', 'author' => 'Ahmad Maulana', 'year' => 2026, 'stock' => 10, 'cat' => 'Pemrograman'],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'year' => 2008, 'stock' => 5, 'cat' => 'Pemrograman'],
            ['title' => 'Eloquent JavaScript', 'author' => 'Marijn Haverbeke', 'year' => 2018, 'stock' => 7, 'cat' => 'Pemrograman'],
            ['title' => 'React Design Patterns', 'author' => 'Addy Osmani', 'year' => 2022, 'stock' => 4, 'cat' => 'Pemrograman'],
            
            // Novel & Fiksi
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'year' => 2005, 'stock' => 8, 'cat' => 'Novel & Fiksi'],
            ['title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'year' => 1980, 'stock' => 3, 'cat' => 'Novel & Fiksi'],
            ['title' => 'Gadis Kretek', 'author' => 'Ratih Kumala', 'year' => 2012, 'stock' => 6, 'cat' => 'Novel & Fiksi'],
            ['title' => 'The Alchemist', 'author' => 'Paulo Coelho', 'year' => 1988, 'stock' => 12, 'cat' => 'Novel & Fiksi'],
            ['title' => 'Negeri 5 Menara', 'author' => 'A. Fuadi', 'year' => 2009, 'stock' => 9, 'cat' => 'Novel & Fiksi'],
            
            // Romance
            // REVISI TAHUN JANE AUSTEN DARI 1813 MENJADI 2013 (Masuk rentang MySQL YEAR 1901-2155)
            ['title' => 'Dilan 1990', 'author' => 'Pidi Baiq', 'year' => 2014, 'stock' => 15, 'cat' => 'Romance'],
            ['title' => 'Antologi Rasa', 'author' => 'Ika Natassa', 'year' => 2011, 'stock' => 5, 'cat' => 'Romance'],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'year' => 2013, 'stock' => 4, 'cat' => 'Romance'],
            
            // Science & Tech
            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'year' => 2011, 'stock' => 10, 'cat' => 'Science & Tech'],
            ['title' => 'Cosmos', 'author' => 'Carl Sagan', 'year' => 1980, 'stock' => 2, 'cat' => 'Science & Tech'],
            ['title' => 'Astrophysics for People in a Hurry', 'author' => 'Neil deGrasse Tyson', 'year' => 2017, 'stock' => 6, 'cat' => 'Science & Tech'],
            
            // Bisnis
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'year' => 2018, 'stock' => 20, 'cat' => 'Bisnis'],
            ['title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'year' => 1997, 'stock' => 10, 'cat' => 'Bisnis'],
            ['title' => 'Start with Why', 'author' => 'Simon Sinek', 'year' => 2009, 'stock' => 7, 'cat' => 'Bisnis'],
            
            // Sejarah
            ['title' => 'A History of Modern Indonesia', 'author' => 'M.C. Ricklefs', 'year' => 2001, 'stock' => 3, 'cat' => 'Sejarah'],
            ['title' => 'Guns, Germs, and Steel', 'author' => 'Jared Diamond', 'year' => 1997, 'stock' => 5, 'cat' => 'Sejarah'],
            
            // Komik & Manga
            ['title' => 'One Piece Vol. 100', 'author' => 'Eiichiro Oda', 'year' => 2021, 'stock' => 25, 'cat' => 'Komik & Manga'],
            ['title' => 'Naruto: The Seventh Hokage', 'author' => 'Masashi Kishimoto', 'year' => 2015, 'stock' => 18, 'cat' => 'Komik & Manga'],
            ['title' => 'Attack on Titan Vol. 1', 'author' => 'Hajime Isayama', 'year' => 2009, 'stock' => 12, 'cat' => 'Komik & Manga'],
            
            // Biografi
            ['title' => 'Steve Jobs', 'author' => 'Walter Isaacson', 'year' => 2011, 'stock' => 6, 'cat' => 'Biografi'],
            ['title' => 'Elon Musk', 'author' => 'Ashlee Vance', 'year' => 2015, 'stock' => 8, 'cat' => 'Biografi'],
            
            // Horor
            ['title' => 'Sewu Dino', 'author' => 'SimpleMan', 'year' => 2019, 'stock' => 10, 'cat' => 'Horor'],
            ['title' => 'Danur', 'author' => 'Risa Saraswati', 'year' => 2011, 'stock' => 7, 'cat' => 'Horor'],
            ['title' => 'It', 'author' => 'Stephen King', 'year' => 1986, 'stock' => 4, 'cat' => 'Horor'],

            // Agama
            ['title' => 'Fiqh Sunnah', 'author' => 'Sayyid Sabiq', 'year' => 1945, 'stock' => 5, 'cat' => 'Agama'],
            ['title' => 'La Tahzan', 'author' => 'Aidh al-Qarni', 'year' => 2001, 'stock' => 15, 'cat' => 'Agama'],
        ];

        foreach ($books as $b) {
            Book::create([
                'title' => $b['title'],
                'author' => $b['author'],
                'published_year' => $b['year'],
                'stock' => $b['stock'],
                'category_id' => $c[$b['cat']]->id,
            ]);
        }
    }
}