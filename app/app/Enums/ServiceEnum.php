<?php 
declare(strict_types=1);
namespace App\Enums;

enum ServiceEnum :int
{
    use EnumTrait;
    case ACTIVE = 1;
    case INACTIVE = 2;

}