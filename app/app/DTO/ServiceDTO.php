<?php
declare(strict_types=1);

namespace App\DTO;
class ServiceDTO extends AbstractDTO
{
     private array $_toArrayData = [];

    public function __construct(
        public string $name,
        public string $uid,
        public ?string $image_url,
        public string $description,
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
            'name' => $this->name,
            'uid' => $this->uid,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status
        ];
    }
}
