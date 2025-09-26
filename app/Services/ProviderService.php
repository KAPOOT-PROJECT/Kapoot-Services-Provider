<?php

namespace App\Services;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class ProviderService
{
    public function verify(ServiceProvider $provider)
    {
        $provider->is_verified = true;
        $provider->verified_at = now();
        $provider->save();
        return $provider;
    }
    public function all(Request $request)
    {
        $query = ServiceProvider::query();
        $query->when($request->has('filtered_active'), function ($query) use ($request) {
            $query->where('is_active', $request->filtered_active);
        });
        $query->when(
            $request->has('sorted_rating'),
            function ($query) use ($request) {
                $query->orderBy('rating', $request->sorted_rating);
            }
        );
        return $query->get();
    }

    public function create(array $data)
    {
        return ServiceProvider::create($data);
    }

    public function update(ServiceProvider $ServiceProvider, array $data)
    {
        $ServiceProvider->update($data);
        return $ServiceProvider;
    }

    public function delete(ServiceProvider $ServiceProvider)
    {
        return $ServiceProvider->delete();
    }
}
