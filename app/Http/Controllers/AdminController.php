<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Dashboard Admin - Statistik dan overview
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_organizers' => User::where('role', 'organizer')->count(),
            'total_events' => Event::count(),
            'pending_events' => Event::pending()->count(),
            'approved_events' => Event::approved()->count(),
            'total_registrations' => Registration::where('status', 'registered')->count(),
        ];

        $recentEvents = Event::with('organizer')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentUsers = User::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentEvents', 'recentUsers'));
    }

    /**
     * Daftar semua event untuk verifikasi
     */
    public function events(Request $request)
    {
        $query = Event::with('organizer');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_event', 'ILIKE', '%' . $search . '%')
                  ->orWhereHas('organizer', function ($q2) use ($search) {
                      $q2->where('nama', 'ILIKE', '%' . $search . '%');
                  });
            });
        }

        $events = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get status counts for summary cards (separate queries for accurate counts)
        $statusCounts = [
            'pending' => Event::where('status', 'pending')->count(),
            'approved' => Event::where('status', 'approved')->count(),
            'rejected' => Event::where('status', 'rejected')->count(),
        ];

        return view('admin.events', compact('events', 'statusCounts'));
    }

    /**
     * Approve event
     */
    public function approveEvent(Event $event)
    {
        $event->update(['status' => 'approved']);

        // Notifikasi ke organizer
        Notification::send(
            $event->organizer_id,
            "Event '{$event->nama_event}' telah disetujui dan sekarang tampil di katalog.",
            $event->event_id
        );

        return back()->with('success', "Event '{$event->nama_event}' berhasil disetujui.");
    }

    /**
     * Reject event
     */
    public function rejectEvent(Request $request, Event $event)
    {
        $request->validate([
            'alasan' => 'nullable|string|max:500',
        ]);

        $event->update(['status' => 'rejected']);

        // Notifikasi ke organizer
        $pesan = "Event '{$event->nama_event}' ditolak.";
        if ($request->filled('alasan')) {
            $pesan .= " Alasan: " . $request->alasan;
        }

        Notification::send(
            $event->organizer_id,
            $pesan,
            $event->event_id
        );

        return back()->with('success', "Event '{$event->nama_event}' telah ditolak.");
    }

    /**
     * Daftar semua users
     */
    public function users(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'ILIKE', '%' . $search . '%')
                  ->orWhere('email', 'ILIKE', '%' . $search . '%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users', compact('users'));
    }

    /**
     * Update role user
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,organizer,admin',
        ]);

        // Jangan izinkan admin mengubah role dirinya sendiri
        if ($user->user_id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat mengubah role Anda sendiri.');
        }

        $oldRole = $user->role;
        $user->update(['role' => $request->role]);

        // Notifikasi ke user
        Notification::send(
            $user->user_id,
            "Role Anda telah diubah dari '{$oldRole}' menjadi '{$request->role}'.",
            null
        );

        return back()->with('success', "Role {$user->nama} berhasil diubah menjadi {$request->role}.");
    }

    /**
     * Hapus user
     */
    public function deleteUser(User $user)
    {
        // Jangan izinkan admin menghapus dirinya sendiri
        if ($user->user_id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $nama = $user->nama;
        $user->delete();

        return back()->with('success', "User {$nama} berhasil dihapus.");
    }
}
