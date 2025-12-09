<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'nama' => 'Admin Eventify',
            'email' => 'admin@eventify.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Organizer User
        $organizer = User::create([
            'nama' => 'Organizer Demo',
            'email' => 'organizer@eventify.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
            'email_verified_at' => now(),
        ]);

        // Create Regular User
        User::create([
            'nama' => 'User Demo',
            'email' => 'user@eventify.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Create Sample Events
        $events = [
            [
                'nama_event' => 'Seminar Inovasi Teknologi 2025',
                'deskripsi' => 'Seminar tentang perkembangan teknologi terkini dan masa depan inovasi digital. Pembicara dari berbagai perusahaan teknologi terkemuka akan berbagi insight dan pengalaman mereka.',
                'tanggal' => now()->addDays(7),
                'waktu_mulai' => '09:00',
                'waktu_selesai' => '12:00',
                'lokasi' => 'Auditorium Universitas Teknologi, Yogyakarta',
                'kuota' => 100,
                'harga' => 50000,
                'kategori' => 'Seminar',
                'status' => 'approved',
            ],
            [
                'nama_event' => 'Workshop UI/UX Design untuk Pemula',
                'deskripsi' => 'Workshop hands-on untuk mempelajari dasar-dasar desain UI/UX. Peserta akan belajar menggunakan Figma dan membuat prototype aplikasi mobile.',
                'tanggal' => now()->addDays(14),
                'waktu_mulai' => '13:00',
                'waktu_selesai' => '17:00',
                'lokasi' => 'Lab Multimedia FTI, Gedung B Lt. 3',
                'kuota' => 30,
                'harga' => 75000,
                'kategori' => 'Workshop',
                'status' => 'approved',
            ],
            [
                'nama_event' => 'Konser Musik Indie Night',
                'deskripsi' => 'Konser musik featuring band-band indie lokal Yogyakarta. Nikmati malam penuh musik dan kebersamaan bersama musisi berbakat.',
                'tanggal' => now()->addDays(21),
                'waktu_mulai' => '19:00',
                'waktu_selesai' => '23:00',
                'lokasi' => 'Taman Budaya Yogyakarta',
                'kuota' => 500,
                'harga' => 100000,
                'kategori' => 'Konser',
                'status' => 'approved',
            ],
            [
                'nama_event' => 'Festival Kuliner Nusantara',
                'deskripsi' => 'Festival makanan tradisional dari berbagai daerah di Indonesia. Ada demo masak, lomba makan, dan bazar kuliner.',
                'tanggal' => now()->addDays(30),
                'waktu_mulai' => '10:00',
                'waktu_selesai' => '21:00',
                'lokasi' => 'Lapangan Alun-alun Utara',
                'kuota' => 1000,
                'harga' => 0,
                'kategori' => 'Festival',
                'status' => 'approved',
            ],
            [
                'nama_event' => 'Webinar Data Science & Machine Learning',
                'deskripsi' => 'Webinar online membahas trend dan aplikasi data science serta machine learning di berbagai industri.',
                'tanggal' => now()->addDays(10),
                'waktu_mulai' => '14:00',
                'waktu_selesai' => '16:00',
                'lokasi' => 'Online via Zoom',
                'kuota' => 200,
                'harga' => 0,
                'kategori' => 'Seminar',
                'status' => 'approved',
            ],
            [
                'nama_event' => 'Kompetisi Hackathon 2025',
                'deskripsi' => 'Kompetisi coding 24 jam untuk mengembangkan solusi inovatif. Hadiah total puluhan juta rupiah!',
                'tanggal' => now()->addDays(45),
                'waktu_mulai' => '08:00',
                'waktu_selesai' => '08:00',
                'lokasi' => 'Gedung Innovation Center',
                'kuota' => 50,
                'harga' => 150000,
                'kategori' => 'Lainnya',
                'status' => 'pending',
            ],
        ];

        foreach ($events as $eventData) {
            Event::create(array_merge($eventData, [
                'organizer_id' => $organizer->user_id,
            ]));
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('');
        $this->command->info('Demo Accounts:');
        $this->command->info('Admin: admin@eventify.com / password');
        $this->command->info('Organizer: organizer@eventify.com / password');
        $this->command->info('User: user@eventify.com / password');
    }
}
