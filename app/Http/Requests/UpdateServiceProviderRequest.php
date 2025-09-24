<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceProviderRequest extends FormRequest
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
            'user_id' => 'sometimes|uuid',
            'business_name' => 'sometimes|string',
            'business_type' => 'nullable|string',
            'description' => 'nullable|string',
            'phone' => 'sometimes|string',
            'email' => 'sometimes|email',
            'business_hours' => 'sometimes|array',
            'address' => 'sometimes|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'license_number' => 'nullable|string',
            'license_expiry' => 'nullable|date',
            'certifications' => 'nullable|array',
            'is_mobile' => 'boolean',
            'mobile_radius_km' => 'integer',
            'commission_rate' => 'numeric',
            'rating' => 'numeric',
            'total_reviews' => 'integer',
            'total_jobs' => 'integer',
            'status' => 'in:active,inactive,suspended,pending_approval',
            'is_verified' => 'boolean',
            'verified_at' => 'nullable|date',
            'documents' => 'nullable|array',
            'photos' => 'nullable|array',
            'payment_details' => 'nullable|array',
            'metadata' => 'nullable|array',
        ];
    }
}
