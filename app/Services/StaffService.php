<?php

namespace App\Services;

use App\Models\Service as ServiceModel;

class ServiceService
{



    public function create(array $serviceData)
    {
        try {
            $service = ServiceModel::create($serviceData);
            return $service;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function all()
    {
        return ServiceModel::all();
    }
    
    public function update(ServiceModel $service, array $data)
    {
        $service->update($data);
        return $service;
    }

    public function delete(ServiceModel $service)
    {
        return $service->delete();
    }
}
