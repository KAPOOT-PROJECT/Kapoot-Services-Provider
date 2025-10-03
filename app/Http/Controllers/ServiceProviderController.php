<?php

namespace App\Http\Controllers;

use App\Helpers\GeoHelper;
use App\Models\ServiceProvider;
use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Services\ProviderService;
use App\Http\Resources\ServiceProviderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ServiceProviderController extends ApiController
{

    public function __construct(private readonly ProviderService $ProviderService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $providers = $this->ProviderService->all($request);
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
        $provider->updateRating((float) $rating);
        return new ServiceProviderResource($provider);
    }

    public function nearest(Request $request)
    {
        try {
            $userLat = $request->input('lat');
            $userLng = $request->input('lng');

            // $nearestDistance = PHP_INT_MAX;
            // $nearestProvider = null;

            // foreach ($providers as $provider) {
            //     $distance = GeoHelper::calculateDistance($userLat, $userLng, $provider->latitude, $provider->longitude);

            //     if ($distance < $nearestDistance) {
            //         $nearestProvider = $provider;
            //         $nearestDistance = $distance;
            //     }
            // }

            $results = Redis::georadius('loc:service-providers', $userLng, $userLat, 20, 'km', [
                'ASC', 'WITHDIST', 'COUNT' => 1
            ]);

            if (empty($results)) {
                return self::error(message: "هیچ خدمات دهنده ای در نزدیکی شما پیدا نشد", code:404);
            }

            return self::success([
                'nearestProvider' => ServiceProvider::find($results[0][0]),
                'nearestDistance' => $results[0][1]
            ]);

        } catch (\Throwable $e) {
            return self::error(message: "{$e->getMessage()} in {$e->getFile()}: {$e->getLine()}.", errors:[
                'trace' => $e->getTrace()
            ]);
        }
    }

public function available(Request $request)
{
    $providers = ServiceProvider::where('status', 'active')
        ->with(['staff' => function($query) {
            $query->available();
        }])
        ->get();

    return ServiceProviderResource::collection($providers);
}
}
