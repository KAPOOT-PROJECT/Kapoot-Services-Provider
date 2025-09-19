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

    public function isActive()
    {
        return $this->status == 'active';
    }
    public function isAvailable()
    {
        return $this->is_available == true;
    }


}
