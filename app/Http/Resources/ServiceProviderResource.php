<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceProviderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'business_name' => $this->business_name,
            'business_type' => $this->business_type,
            'description' => $this->description,
            'phone' => $this->phone,
            'email' => $this->email,
            'business_hours' => $this->business_hours,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'license_number' => $this->license_number,
            'license_expiry' => $this->license_expiry,
            'certifications' => $this->certifications,
            'is_mobile' => $this->is_mobile,
            'mobile_radius_km' => $this->mobile_radius_km,
            'commission_rate' => $this->commission_rate,
            'rating' => $this->rating,
            'total_reviews' => $this->total_reviews,
            'total_jobs' => $this->total_jobs,
            'status' => $this->status,
            'is_verified' => $this->is_verified,
            'verified_at' => $this->verified_at,
            'documents' => $this->documents,
            'photos' => $this->photos,
            'payment_details' => $this->payment_details,
            'metadata' => $this->metadata,
            'staff'    =>  ServiceProviderStaffResource::collection($this->staff),
        ];
    }
}
