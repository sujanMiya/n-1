<?php 
declare(strict_types=1);
namespace App\Enums;

enum BookingEnum :int
{
    use EnumTrait;
    case PENDING = 1;
    case CONFIRMED = 2;
    case CANCELLED = 3;
    case COMPLETED = 4;
    case NO_SHOW = 5;

}