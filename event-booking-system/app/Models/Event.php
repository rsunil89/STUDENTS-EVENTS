<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'capacity',
        'status',
        'user_id',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function bookingCount(): int
    {
        return $this->bookings()->where('status', 'confirmed')->count();
    }

    public function hasAvailableSpots(): bool
    {
        return $this->bookingCount() < $this->capacity;
    }

    public function remainingSpots(): int
    {
        return $this->capacity - $this->bookingCount();
    }
}
