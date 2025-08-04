<?php 
declare(strict_types=1);
namespace App\Services;
use app\Models\Service;
class BookingService
{
    public function storData(array $data): Service
    {
        return Service::create($data);
    }
}

