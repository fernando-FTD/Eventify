<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    /**
     * Tampilkan katalog event (public) - hanya yang approved
     */
    public function index(Request $request)
    {
        $query = Event::with('organizer')->approved();

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan lokasi
        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'ILIKE', '%' . $request->lokasi . '%');
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Search berdasarkan nama atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_event', 'ILIKE', '%' . $search . '%')
                  ->orWhere('deskripsi', 'ILIKE', '%' . $search . '%')
                  ->orWhere('lokasi', 'ILIKE', '%' . $search . '%');
            });
        }

        // Urutkan berdasarkan tanggal terdekat
        $events = $query->orderBy('tanggal', 'asc')->paginate(12);

        // Ambil kategori unik untuk filter
        $kategoris = Event::approved()->distinct()->pluck('kategori');

        return view('events.index', compact('events', 'kategoris'));
    }

    /**
     * Tampilkan detail event
     */
    public function show(Event $event)
    {
        // Load relasi
        $event->load('organizer');
        
        // Cek apakah user sudah terdaftar
        $isRegistered = false;
        $registration = null;
        
        if (Auth::check()) {
            $registration = $event->registrations()
                ->where('user_id', Auth::id())
                ->where('status', 'registered')
                ->first();
            $isRegistered = $registration !== null;
        }

        return view('events.show', compact('event', 'isRegistered', 'registration'));
    }

    /**
     * Tampilkan daftar event milik organizer
     */
    public function myEvents()
    {
        $events = Event::where('organizer_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('organizer.my-events', compact('events'));
    }

    /**
     * Form buat event baru
     */
    public function create()
    {
        $kategoris = ['Seminar', 'Workshop', 'Konser', 'Webinar', 'Kompetisi', 'Lainnya'];
        return view('organizer.create-event', compact('kategoris'));
    }

    /**
     * Simpan event baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date|after:today',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kuota' => 'required|integer|min:1',
        ]);

        // Handle upload poster
        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $validated['organizer_id'] = Auth::id();
        $validated['status'] = 'pending';

        $event = Event::create($validated);

        // Notifikasi ke admin bahwa ada event baru perlu review
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::send(
                $admin->user_id,
                "Event baru '{$event->nama_event}' menunggu verifikasi.",
                $event->event_id
            );
        }        return redirect()->route('organizer.events')
            ->with('success', 'Event berhasil dibuat dan menunggu persetujuan admin.');
    }

    /**
     * Form edit event
     */
    public function edit(Event $event)
    {
        // Pastikan hanya organizer pemilik yang bisa edit
        if ($event->organizer_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $kategoris = ['Seminar', 'Workshop', 'Konser', 'Webinar', 'Kompetisi', 'Lainnya'];
        return view('organizer.edit-event', compact('event', 'kategoris'));
    }

    /**
     * Update event
     */
    public function update(Request $request, Event $event)
    {
        // Pastikan hanya organizer pemilik yang bisa update
        if ($event->organizer_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kuota' => 'required|integer|min:1',
        ]);

        // Handle upload poster baru
        if ($request->hasFile('poster')) {
            // Hapus poster lama jika ada
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $oldStatus = $event->status;
        $event->update($validated);

        // Jika event sudah approved dan ada perubahan, kirim notifikasi ke peserta
        if ($oldStatus === 'approved') {
            $registrations = $event->registrations()->where('status', 'registered')->get();
            foreach ($registrations as $reg) {
                Notification::send(
                    $reg->user_id,
                    "Event '{$event->nama_event}' telah diperbarui. Silakan cek detail terbaru.",
                    $event->event_id
                );
            }
        }        return redirect()->route('organizer.events')
            ->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Hapus event
     */
    public function destroy(Event $event)
    {
        // Pastikan hanya organizer pemilik atau admin yang bisa hapus
        if ($event->organizer_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        // Notifikasi ke peserta bahwa event dibatalkan
        $registrations = $event->registrations()->where('status', 'registered')->get();
        foreach ($registrations as $reg) {
            Notification::send(
                $reg->user_id,
                "Event '{$event->nama_event}' telah dibatalkan.",
                null
            );
        }

        // Hapus poster jika ada
        if ($event->poster) {
            Storage::disk('public')->delete($event->poster);
        }

        $event->delete();

        return redirect()->route('organizer.events')
            ->with('success', 'Event berhasil dihapus.');
    }
}
