<?php
declare(strict_types=1);
namespace App\Services;
use App\DTO\BookingDTO;
use App\Models\Booking;
use app\Models\Service;
use Arr;
class BookingService
{
    public function store(array $data): Service
    {
        dd($data);
        return Service::create($data);
    }
    public function createBooking(array $data): Booking
    {
        $bookingDto = $this->prepareBookingDTO($data);
        return $this->storeBooking($bookingDto);
    }
    private function storeBooking(BookingDTO $bookingDto): Booking
    {
        return Booking::create($bookingDto->toArray());
    }
    private function prepareBookingDTO(array $data): BookingDTO
    {
        return new BookingDTO(
            user_id: Arr::get($data, 'user_id'),
            uid: str_unique_with_prefix('Bo-'),
            service_id: Arr::get($data, 'service_id'),
            note: Arr::get($data, 'note'),
            price: Arr::get($data, 'price'),
            start_date: Arr::get($data, 'start_date'),
            end_date: Arr::get($data, 'end_date'),
            status: Arr::get($data, 'status'),
        );
    }
}

