<?php 
declare(strict_types=1);
namespace App\Enums;

enum ServiceEnum :string
{
    use EnumTrait;
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

}