<?php

namespace App\Http\Controllers;

use App\Models\ServiceProviderStaff;
use App\Http\Requests\StoreServiceProviderStaffRequest;
use App\Http\Requests\UpdateServiceProviderStaffRequest;
use App\Services\StaffService;
use App\Http\Resources\ServiceProviderStaffResource;

class ServiceProviderStaffController extends Controller
{

    public function __construct(private readonly StaffService $StaffService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = $this->StaffService->all();
        return ServiceProviderStaffResource::collection($staff);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceProviderStaffRequest $request)
    {
        $staff = $this->StaffService->create($request->validated());
        return (new ServiceProviderStaffResource($staff))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceProviderStaff $providersStaff)
    {
        return new ServiceProviderStaffResource($providersStaff);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceProviderStaffRequest $request, ServiceProviderStaff $providersStaff)
    {
        $staff = $this->StaffService->update($providersStaff, $request->validated());
        return new ServiceProviderStaffResource($staff);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceProviderStaff $providersStaff)
    {
        $this->StaffService->delete($providersStaff);
        return response()->json(['message' => 'deleted']);
    }

    public function setAvailability(ServiceProviderStaff $providersStaff)
    {
        $available = request('is_available');
        if ($available) {
            $providersStaff->setAvailable();
        } else {
            $providersStaff->setUnavailable();
        }
        return new ServiceProviderStaffResource($providersStaff);
    }

    public function assignToBooking(ServiceProviderStaff $providersStaff)
    {
        $bookingId = request('booking_id');
        if (!$bookingId) {
            return response()->json(['message' => 'booking_id required'], 422);
        }
        $providersStaff->assignToBooking($bookingId);
        return new ServiceProviderStaffResource($providersStaff);
    }

    public function completeBooking(ServiceProviderStaff $providersStaff)
    {
        $providersStaff->completeBooking();
        return new ServiceProviderStaffResource($providersStaff);
    }

    public function updateRating(ServiceProviderStaff $providersStaff)
    {
        $rating = request('rating');
        if (!is_numeric($rating)) {
            return response()->json(['message' => 'Invalid rating'], 422);
        }
        $providersStaff->updateRating((float)$rating);
        return new ServiceProviderStaffResource($providersStaff);
    }
}
