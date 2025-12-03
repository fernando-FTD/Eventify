@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">Pusat Bantuan</h1>

    <p class="text-gray-700 leading-relaxed mb-6">
        Butuh bantuan menggunakan Eventify? Berikut beberapa informasi yang dapat membantu
        kamu memahami cara menggunakan platform ini.
    </p>

    <div class="space-y-4">
        <div>
            <h2 class="text-xl font-semibold text-indigo-600">Cara Mendaftar Event</h2>
            <p class="text-gray-700">
                Pilih event yang kamu inginkan lalu tekan tombol <strong>Daftar</strong>. 
                Kamu akan menerima notifikasi setelah pendaftaran berhasil.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-semibold text-indigo-600">Melihat Event yang Kamu Ikuti</h2>
            <p class="text-gray-700">
                Buka menu <strong>Dashboard</strong> lalu pilih bagian 
                <strong>Event Saya</strong> untuk melihat semua event yang sudah kamu daftar.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-semibold text-indigo-600">Butuh Bantuan Lain?</h2>
            <p class="text-gray-700">
                Jika masih ada pertanyaan, kamu dapat menghubungi admin melalui halaman 
                <strong>Kontak</strong>.
            </p>
        </div>
    </div>
</div>
@endsection
