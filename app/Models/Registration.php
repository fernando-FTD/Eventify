<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registration extends Model
{
    use HasFactory;

    protected $primaryKey = 'registration_id';

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'registration_id';
    }

    protected $fillable = [
        'user_id',
        'event_id',
        'status',
    ];

    /**
     * Registration dimiliki oleh satu user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Registration untuk satu event
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    /**
     * Registration memiliki satu e-ticket
     */
    public function eticket(): HasOne
    {
        return $this->hasOne(Eticket::class, 'registration_id', 'registration_id');
    }
}
