<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'notif_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'pesan',
        'status',
    ];

    /**
     * Notification dimiliki oleh satu user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Notification terkait dengan satu event (nullable)
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    /**
     * Scope untuk notifikasi yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'terkirim');
    }

    /**
     * Scope untuk notifikasi yang sudah dibaca
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'dibaca');
    }

    /**
     * Tandai sebagai sudah dibaca
     */
    public function markAsRead(): void
    {
        $this->update(['status' => 'dibaca']);
    }

    /**
     * Buat notifikasi baru untuk user
     */
    public static function send(int $userId, string $pesan, ?int $eventId = null): self
    {
        return self::create([
            'user_id' => $userId,
            'event_id' => $eventId,
            'pesan' => $pesan,
            'status' => 'terkirim',
        ]);
    }
}
