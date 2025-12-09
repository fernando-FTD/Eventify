<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Eticket extends Model
{
    use HasFactory;

    protected $primaryKey = 'ticket_id';

    protected $fillable = [
        'registration_id',
        'qr_code',
        'waktu_checkin',
    ];

    protected $casts = [
        'waktu_checkin' => 'datetime',
    ];

    /**
     * E-ticket dimiliki oleh satu registration (1:1)
     */
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class, 'registration_id', 'registration_id');
    }

    /**
     * Cek apakah sudah check-in
     */
    public function isCheckedIn(): bool
    {
        return $this->waktu_checkin !== null;
    }

    /**
     * Generate unique QR code string
     */
    public static function generateQrCode(): string
    {
        return 'EVT-' . strtoupper(bin2hex(random_bytes(8))) . '-' . time();
    }
}
