<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'event_id';
    }

    protected $fillable = [
        'organizer_id',
        'nama_event',
        'kategori',
        'deskripsi',
        'lokasi',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'poster',
        'kuota',
        'harga',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    /**
     * Event dimiliki oleh satu organizer (User)
     */
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id', 'user_id');
    }

    /**
     * Event memiliki banyak registrasi
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'event_id', 'event_id');
    }

    /**
     * Event memiliki banyak notifikasi
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'event_id', 'event_id');
    }

    /**
     * Scope untuk event yang sudah approved
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope untuk event yang pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Hitung sisa kuota
     */
    public function sisaKuota(): int
    {
        $registered = $this->registrations()->where('status', 'registered')->count();
        return max(0, $this->kuota - $registered);
    }

    /**
     * Cek apakah kuota masih tersedia
     */
    public function kuotaTersedia(): bool
    {
        return $this->sisaKuota() > 0;
    }
}
