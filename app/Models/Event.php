<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['title', 'type', 'date', 'location', 'budget', 'user_id'])]
class Event extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'budget' => 'decimal:2',
        ];
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getTotalCostAttribute(): float
    {
        return $this->bookings->where('status', '!=', 'cancelled')->sum('total_price');
    }

    public function getBookingsByCategoryAttribute(): array
    {
        return $this->bookings->load('vendorPackage.vendor')
            ->groupBy(fn($b) => $b->vendorPackage->vendor->category)
            ->toArray();
    }
}
