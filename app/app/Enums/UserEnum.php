<?php 
declare(strict_types=1);
namespace App\Enums;

enum UserEnum : string
{
    case USER = 'user';
    case ADMIN = 'admin';
    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }
}