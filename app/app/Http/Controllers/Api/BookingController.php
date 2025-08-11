<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Requests\BookingRequest;
use App\Services\BookingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    protected BookingService $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    public function index(Request $request){}
    public function store(BookingRequest $request)
    {
        $bookins = $this->bookingService->createBooking($request->validated());
    }
}
