<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        if ($admin) {
            Berita::create([
                'judul' => 'Berita Pertama',
                'konten' => 'Ini adalah konten berita pertama.',
                'foto' => 'berita/default.jpg', // Pastikan file ini ada di storage/app/public/berita/
                'user_id' => $admin->id,
            ]);
        }
    }
}
