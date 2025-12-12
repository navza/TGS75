<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Berita;
use App\Models\Komentar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create test users
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Create sample news
        $berita1 = Berita::create([
            'user_id' => $user1->id,
            'judul' => 'Laravel Passport Authentication Guide',
            'isi' => 'Learn how to implement OAuth2 authentication in Laravel using Passport. This comprehensive guide covers token generation, validation, and best practices for securing your API endpoints.',
        ]);

        $berita2 = Berita::create([
            'user_id' => $user2->id,
            'judul' => 'Flutter dan SQLite Integration',
            'isi' => 'Panduan lengkap untuk mengintegrasikan SQLite database ke dalam aplikasi Flutter. Pelajari bagaimana menyimpan data lokal, melakukan query, dan sinkronisasi dengan server backend.',
        ]);

        $berita3 = Berita::create([
            'user_id' => $user1->id,
            'judul' => 'Building REST API with Laravel',
            'isi' => 'Discover the best practices for building scalable REST APIs using Laravel. This article covers routing, middleware, error handling, and documentation strategies.',
        ]);

        // Add sample comments
        Komentar::create([
            'berita_id' => $berita1->id,
            'user_id' => $user2->id,
            'isi' => 'Great article! Really helpful for understanding Passport authentication.',
        ]);

        Komentar::create([
            'berita_id' => $berita1->id,
            'user_id' => $user1->id,
            'isi' => 'Thanks for the detailed explanation. Works perfectly!',
        ]);

        Komentar::create([
            'berita_id' => $berita2->id,
            'user_id' => $user1->id,
            'isi' => 'Sangat berguna! Tutorial SQLite di sini sangat jelas.',
        ]);

        Komentar::create([
            'berita_id' => $berita3->id,
            'user_id' => $user2->id,
            'isi' => 'Excellent resource for API development. Bookmarked!',
        ]);
    }
}
