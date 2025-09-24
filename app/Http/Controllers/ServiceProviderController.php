<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Services\ProviderService;
use App\Http\Resources\ServiceProviderResource;


class ServiceProviderController extends Controller
{

    public function __construct(private readonly ProviderService $ProviderService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = $this->ProviderService->all();
        return ServiceProviderResource::collection($providers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceProviderRequest $request)
    {
        $provider = $this->ProviderService->create($request->validated());
        return (new ServiceProviderResource($provider))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceProvider $provider)
    {
        return new ServiceProviderResource($provider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceProviderRequest $request, ServiceProvider $provider)
    {
        $provider = $this->ProviderService->update($provider, $request->validated());
        return new ServiceProviderResource($provider);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceProvider $provider)
    {
        $this->ProviderService->delete($provider);
        return response()->json(['message' => 'deleted']);
    }


    public function verify(ServiceProvider $provider)
    {
        $provider = $this->ProviderService->verify($provider);
        return new ServiceProviderResource($provider);
    }

    public function updateRating(ServiceProvider $provider)
    {
        $rating = request('rating');
        if (!is_numeric($rating)) {
            return response()->json(['message' => 'Invalid rating'], 422);
        }
        $provider->updateRating((float)$rating);
        return new ServiceProviderResource($provider);
    }
}
