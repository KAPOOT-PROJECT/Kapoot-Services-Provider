<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;


class ServiceProviderStaff extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceProviderStaffFactory> */
    use HasFactory;

    protected $guarded = [];

    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }


    public function isAvailableForWork(): bool
    {
        return $this->status === 'active' && $this->is_available;
    }


    public function isOnJob(): bool
    {
        return $this->status === 'on_job' && !is_null($this->active_booking_id);
    }


    public function updateLocation(float $lat, float $lng): void
    {
        $this->update([
            'current_latitude' => $lat,
            'current_longitude' => $lng,
            'location_updated_at' => now(),
        ]);
    }


    public function assignToBooking(string $bookingId): void
    {
        $this->update([
            'active_booking_id' => $bookingId,
            'status' => 'on_job',
            'is_available' => false,
        ]);
    }


    public function completeBooking(): void
    {
        $this->update([
            'active_booking_id' => null,
            'status' => 'active',
            'is_available' => true,
            'total_services' => $this->total_services + 1,
        ]);
    }


    public function updateRating(float $newRating): void
    {
        $total = $this->total_reviews;
        $current = $this->rating;

        $updatedRating = (($current * $total) + $newRating) / ($total + 1);

        $this->rating = round($updatedRating, 2);
        $this->total_reviews = $total + 1;

        $this->save();
    }



    public function setUnavailable(): void
    {
        $this->update(['is_available' => false, 'status' => 'offline']);
    }


    public function setAvailable(): void
    {
        $this->update(['is_available' => true, 'status' => 'active']);
    }


    #[Scope]
    public function active(Builder $query): void
    {
        $query->where('status', 'active');
    }
    #[Scope]
    public function available(Builder $query): void
    {
        $query->where('is_available', true);
    }
    #[Scope]
    public function Online(Builder $query): void
    {
        $query->where('status', '!=', 'offline');
    }
    #[Scope]
    public function ByProvider(Builder $query, int $providerId): void
    {
        $query->where('provider_id', $providerId);
    }


    protected $casts = [
        'specializations' => 'array',
        'certifications' => 'array',
        'is_available' => 'boolean',
        'current_latitude' => 'decimal:8',
        'current_longitude' => 'decimal:8',
        'location_updated_at' => 'datetime',
        'active_booking_id' => 'string', // uuid
        'rating' => 'decimal:2',
        'total_services' => 'integer',
        'working_hours' => 'array',
        'hourly_rate' => 'decimal:2',
        'hired_date' => 'date',
        'emergency_contact' => 'array',
        'documents' => 'array',
        'metadata' => 'array',
    ];
}
