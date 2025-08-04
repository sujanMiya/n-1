<?php

namespace App\Http\Controllers\Api;

use App\Services\Services;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ServiceRequest $request)
    {
        try {
            $service = $this->service->storData($request->validated());
            return apiSuccessResponse($service, 'Service Create successfully', 200);
        } catch (\Exception $e) {
            return apiErrorResponse('Service Create failed: ' . $e->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
