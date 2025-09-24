<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceProviderStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|uuid',
            'provider_id' => 'required|integer|exists:service_providers,id',
            'user_id' => 'nullable|uuid',
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'specializations' => 'nullable|array',
            'certifications' => 'nullable|array',
            'is_available' => 'boolean',
            'current_latitude' => 'nullable|numeric',
            'current_longitude' => 'nullable|numeric',
            'location_updated_at' => 'nullable|date',
            'assigned_vehicle' => 'nullable|string',
            'active_booking_id' => 'nullable|uuid',
            'rating' => 'numeric',
            'total_services' => 'integer',
            'working_hours' => 'nullable|array',
            'status' => 'in:active,on_break,offline,on_job',
            'hourly_rate' => 'nullable|numeric',
            'hired_date' => 'nullable|date',
            'emergency_contact' => 'nullable|array',
            'documents' => 'nullable|array',
            'profile_photo' => 'nullable|string',
            'metadata' => 'nullable|array',
        ];
    }
}
