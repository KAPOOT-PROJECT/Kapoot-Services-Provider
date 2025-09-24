<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceProviderStaffResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'provider_id' => $this->provider_id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'specializations' => $this->specializations,
            'certifications' => $this->certifications,
            'is_available' => $this->is_available,
            'current_latitude' => $this->current_latitude,
            'current_longitude' => $this->current_longitude,
            'location_updated_at' => $this->location_updated_at,
            'assigned_vehicle' => $this->assigned_vehicle,
            'active_booking_id' => $this->active_booking_id,
            'rating' => $this->rating,
            'total_reviews' => $this->total_reviews,
            'total_services' => $this->total_services,
            'working_hours' => $this->working_hours,
            'status' => $this->status,
            'hourly_rate' => $this->hourly_rate,
            'hired_date' => $this->hired_date,
            'emergency_contact' => $this->emergency_contact,
            'documents' => $this->documents,
            'profile_photo' => $this->profile_photo,
            'metadata' => $this->metadata,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
