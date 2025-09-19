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
}
