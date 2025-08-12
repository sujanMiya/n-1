<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    protected BookingService $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    public function allBookingListForAdmin(Request $request): JsonResponse
    {
        try {
            if (!$request->user()->isAdmin())
                return apiErrorResponse('You are not authorized to view this resource', 403);

            $bookings = $this->bookingService->allBookingList($request->user());
            return api([
                'services' => $bookings->toArray()['data'] ?? [],
                'meta' => pagination_meta($bookings),
            ])->success(__('success'));
        } catch (\Exception $e) {
            return apiErrorResponse('Booking show failed: ' . $e->getMessage(), 400);
        }
    }
    public function allBookingListForUser(Request $request): JsonResponse
    {
        try {
            $bookings = $this->bookingService->allBookingListForUser($request->user());
            return api([
                'services' => $bookings->toArray()['data'] ?? [],
                'meta' => pagination_meta($bookings),
            ])->success(__('success'));
        } catch (\Exception $e) {
            return apiErrorResponse('Booking show failed: ' . $e->getMessage(), 400);
        }
    }
    public function store(BookingRequest $request): JsonResponse
    {
        try {
            $bookings = $this->bookingService->createBooking($request->user(), $request->validated());
            return apiSuccessResponse(new BookingResource($bookings), 'Booking Create successfully', 200);
        } catch (\Exception $e) {
            return apiErrorResponse('Booking failed: ' . $e->getMessage(), 400);
        }
    }
}
