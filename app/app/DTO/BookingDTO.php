<?php
declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;
class BookingDTO extends AbstractDTO
{
     private array $_toArrayData = [];

    public function __construct(
        public int $user_id,
        public int $service_id,
        public string $uid,
        public ?string $note,
        public ?Carbon $start_date,
        public ?Carbon $end_date,
        public ?float $price,
        public int $status,
    )
    {
    }
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'uid' => $this->uid,
            'service_id' => $this->service_id,
            'note' => $this->note,
            'price' => $this->price,
            'start_date' => $this->start_date?->toDateTimeString(),
            'end_date' => $this->end_date?->toDateTimeString(),
            'status' => $this->status,
        ];
    }
}
