<?php 
declare(strict_types=1);

namespace App\Services;

use App\Enums\UserEnum;
use App\Models\User;

class RegisterService
{
    public function registerUser(array $data): User
    {
        // Create a new user record in the database
        //use Dto
      $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? UserEnum::USER,
        ]);
        //create user
        $user['access_token'] = $this->tokenGenaret($user);
        $user['token_type'] = 'Bearer';
        return $user;
    }
    public function tokenGenaret(User $user): string
    {
        return $user->createToken('auth_token')->accessToken;
    }
}
