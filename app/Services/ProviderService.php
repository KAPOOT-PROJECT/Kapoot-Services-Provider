<?php

namespace App\Services;

use App\Models\ServiceProvider;

class ProviderService
{
    public function all()
    {
        return ServiceProvider::all();
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
