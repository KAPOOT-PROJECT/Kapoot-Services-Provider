<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceProviderFactory> */
    use HasFactory;

    protected $guarded = [];

    public function Staff()
    {
        return $this->hasMany(ServiceProviderStaff::class);
    }

    #[Scope]
    public function active(Builder $query): void
    {
        $query->where('status', 'active');
    }

    #[Scope]
    public function expired(Builder $query): void
    {
        $query->where('license_expiry', '<=', now());
    }

    public function isActive()
    {
        return $this->status == 'active';
    }
    public function isExpired()
    {
        return $this->license_expiry <= now();
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

    public function incrementJobs(): void
    {
        $this->increment('total_jobs');
    }


    protected $casts = [
        'business_hours'   => 'array',
        'address'          => 'array',
        'certifications'   => 'array',
        'documents'        => 'array',
        'photos'           => 'array',
        'payment_details'  => 'array',
        'metadata'         => 'array',
        'is_mobile'        => 'boolean',
        'is_verified'      => 'boolean',
        'verified_at'      => 'datetime',
        'license_expiry'   => 'date',
    ];
}
