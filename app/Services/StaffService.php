<?php

namespace App\Services;

use App\Models\ServiceProviderStaff;


class StaffService
{
    public function create(array $data)
    {
        return ServiceProviderStaff::create($data);
    }

    public function all()
    {
        return ServiceProviderStaff::all();
    }

    public function update(ServiceProviderStaff $staff, array $data)
    {
        $staff->update($data);
        return $staff;
    }

    public function delete(ServiceProviderStaff $staff)
    {
        return $staff->delete();
    }
}
