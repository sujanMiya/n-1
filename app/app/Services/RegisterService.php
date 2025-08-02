<?php 
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\Register;
use Illuminate\Support\Carbon;
use App\Http\Requests\RegisterRequest;

class RegisterService
{
    public function registerUser(array $data): User
    {
        // Create a new user record in the database
      $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? 'user',
        ]);
        $user['access_token'] = $user->createToken('auth_token')->accessToken;
        $user['token_type'] = 'Bearer';
        return $user;
    }
}
