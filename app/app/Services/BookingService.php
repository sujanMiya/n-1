<?php
declare(strict_types=1);
namespace App\Services;
use App\DTO\BookingDTO;
use App\Models\Booking;
use app\Models\Service;
use App\Models\User;
use Arr;
use Carbon\Carbon;
class BookingService
{
    public function store(array $data): Service
    {
        dd($data);
        return Service::create($data);
    }
    public function createBooking(User $user, array $data): Booking
    {
        $bookingDto = $this->prepareBookingDTO($user->id, $data);
        return $this->storeBooking($user,$bookingDto);
    }
    private function storeBooking(User $user, BookingDTO $bookingDto): Booking
    {
        return $user->bookings()->create($bookingDto->toArray());
    }
    private function prepareBookingDTO($userId, array $data): BookingDTO
    {
        return new BookingDTO(
            user_id: $userId,
            uid: str_unique_with_prefix('Bo-'),
            service_id: Arr::get($data, 'service_id'),
            note: Arr::get($data, 'note'),
            price: Arr::get($data, 'price'),
            start_date:  Arr::get($data, 'start_date') ? Carbon::parse(Arr::get($data, 'start_date')) : null,
            end_date: Arr::get($data, 'end_date') ? Carbon::parse(Arr::get($data, 'end_date')) : null,
            status: Arr::get($data, 'status'),
        );
    }
}

