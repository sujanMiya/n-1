<?php 
declare(strict_types=1);
namespace App\Enums;

enum UserRoleEnum : int
{
    use EnumTrait;
    case ADMIN = 1;
    case USER = 2;

}