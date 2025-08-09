<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ServiceResource;
use App\Services\Services;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    protected Services $service;
    public function __construct(Services $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $services = $this->service->all();
            return api([
                'services' => $services->toArray()['data'] ?? [],
                'meta' => pagination_meta($services),
            ])->success(__('success'));
            // return JsonResource::collection($service);
        } catch (\Exception $e) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(ServiceRequest $request): JsonResponse
    {
        try {
            $service = $this->service->store($request->validated());
            return apiSuccessResponse(new ServiceResource($service), 'Service Create successfully', 200);
        } catch (\Exception $e) {
            return apiErrorResponse('Service Create failed: ' . $e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
