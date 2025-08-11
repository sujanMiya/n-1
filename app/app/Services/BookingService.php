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
        return $bookingDto = $this->prepareookingDTO($data);
    }
    private function prepareookingDTO(array $data): BookingDTO
    {
        return new BookingDTO(
            name: Arr::get($data, 'name'),
            uid: str_unique_with_prefix('Bo-'),
            image_url: Arr::get($data, 'image_url'),
            description: Arr::get($data, 'description'),
            price: Arr::get($data, 'price'),
            status: Arr::get($data, 'status'),
        );
    }
}

