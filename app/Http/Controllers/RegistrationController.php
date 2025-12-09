<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Eticket;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class RegistrationController extends Controller
{
    /**
     * Daftarkan user ke event
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,event_id',
        ]);

        $event = Event::findOrFail($request->event_id);

        // Cek apakah event sudah approved
        if ($event->status !== 'approved') {
            return back()->with('error', 'Event ini belum tersedia untuk pendaftaran.');
        }

        // Cek apakah kuota masih tersedia
        if (!$event->kuotaTersedia()) {
            return back()->with('error', 'Maaf, kuota event sudah penuh.');
        }

        // Cek apakah user sudah terdaftar
        $existingReg = Registration::where('user_id', Auth::id())
            ->where('event_id', $event->event_id)
            ->where('status', 'registered')
            ->first();

        if ($existingReg) {
            return back()->with('error', 'Anda sudah terdaftar di event ini.');
        }

        DB::beginTransaction();
        try {
            // Buat registrasi
            $registration = Registration::create([
                'user_id' => Auth::id(),
                'event_id' => $event->event_id,
                'status' => 'registered',
            ]);

            // Generate e-ticket dengan QR code
            $qrCodeString = Eticket::generateQrCode();
            Eticket::create([
                'registration_id' => $registration->registration_id,
                'qr_code' => $qrCodeString,
                'waktu_checkin' => null,
            ]);

            // Kirim notifikasi ke user
            Notification::send(
                Auth::id(),
                "Selamat! Anda berhasil terdaftar di event '{$event->nama_event}'.",
                $event->event_id
            );

            // Kirim notifikasi ke organizer
            Notification::send(
                $event->organizer_id,
                "Peserta baru mendaftar di event '{$event->nama_event}'.",
                $event->event_id
            );

            DB::commit();

            return redirect()->route('registrations.my-tickets')
                ->with('success', 'Pendaftaran berhasil! E-ticket Anda sudah tersedia.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi.');
        }
    }

    /**
     * Tampilkan tiket milik user
     */
    public function myTickets()
    {
        $registrations = Registration::with(['event', 'eticket'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.my-tickets', compact('registrations'));
    }    /**
     * Tampilkan detail tiket dengan QR code dinamis
     */
    public function showTicket(Registration $registration)
    {
        // Pastikan tiket milik user yang login
        if ($registration->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke tiket ini.');
        }        $registration->load(['event', 'eticket']);

        // Generate QR code image sebagai SVG
        $qrCode = null;
        if ($registration->eticket) {            $options = new QROptions([
                'outputType' => QRCode::OUTPUT_MARKUP_SVG,
                'eccLevel' => QRCode::ECC_M, // Medium error correction
                'scale' => 6, // Ukuran sedang
                'imageBase64' => false,
            ]);
            // Generate QR code dari string unik tiket
            $qrCode = (new QRCode($options))->render($registration->eticket->qr_code);
        }

        return view('user.ticket-detail', compact('registration', 'qrCode'));
    }    /**
     * Batalkan registrasi
     */
    public function cancel(Registration $registration)
    {
        // Pastikan registrasi milik user yang login
        if ($registration->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        // Cek apakah masih bisa dibatalkan (misalnya event belum mulai)
        if ($registration->event->tanggal <= now()) {
            return back()->with('error', 'Tidak dapat membatalkan pendaftaran karena event sudah dimulai.');
        }

        $registration->update(['status' => 'cancelled']);

        // Notifikasi
        Notification::send(
            Auth::id(),
            "Pendaftaran Anda di event '{$registration->event->nama_event}' telah dibatalkan.",
            $registration->event_id
        );

        return redirect()->route('registrations.my-tickets')
            ->with('success', 'Pendaftaran berhasil dibatalkan.');
    }

    /**
     * Tampilkan daftar peserta event (untuk organizer)
     */
    public function participants(Event $event)
    {
        // Pastikan organizer pemilik atau admin
        if ($event->organizer_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $registrations = Registration::with(['user', 'eticket'])
            ->where('event_id', $event->event_id)
            ->where('status', 'registered')
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        return view('organizer.participants', compact('event', 'registrations'));
    }

    /**
     * Halaman scan QR untuk check-in (untuk organizer)
     */
    public function scanQr(Event $event)
    {
        // Pastikan organizer pemilik atau admin
        if ($event->organizer_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return view('organizer.scan-qr', compact('event'));
    }    /**
     * Proses check-in peserta via QR code (support format dinamis dan legacy)
     */
    public function checkIn(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
            'event_id' => 'required|exists:events,event_id',
        ]);

        $event = Event::findOrFail($request->event_id);        // Pastikan organizer pemilik atau admin
        if ($event->organizer_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
        }

        // Cari e-ticket berdasarkan QR code
        $eticket = Eticket::where('qr_code', $request->qr_code)->first();

        if (!$eticket) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak valid.'
            ]);
        }

        // Pastikan tiket untuk event yang benar
        $registration = $eticket->registration;
        if ($registration->event_id !== $event->event_id) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket ini bukan untuk event ini.'
            ]);
        }

        // Cek apakah sudah check-in
        if ($eticket->isCheckedIn()) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta sudah melakukan check-in sebelumnya pada ' . $eticket->waktu_checkin->format('d M Y H:i')
            ]);
        }

        // Proses check-in
        $eticket->update(['waktu_checkin' => now()]);

        $user = $registration->user;

        return response()->json([
            'success' => true,
            'message' => 'Check-in berhasil!',
            'data' => [
                'nama' => $user->nama,
                'email' => $user->email,
                'waktu_checkin' => now()->format('d M Y H:i:s'),
            ]
        ]);
    }
}
