<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Tampilkan semua notifikasi user
     */
    public function index()
    {
        $notifications = Notification::with('event')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('user.notifications', compact('notifications'));
    }

    /**
     * Tandai satu notifikasi sebagai dibaca
     */
    public function markAsRead(Notification $notification)
    {
        // Pastikan notifikasi milik user yang login
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $notification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    /**
     * Tandai semua notifikasi sebagai dibaca
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('status', 'terkirim')
            ->update(['status' => 'dibaca']);

        return back()->with('success', 'Semua notifikasi ditandai sebagai dibaca.');
    }

    /**
     * Ambil jumlah notifikasi yang belum dibaca (untuk AJAX)
     */
    public function getUnreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->unread()
            ->count();

        return response()->json(['count' => $count]);
    }
}
