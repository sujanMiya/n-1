<?php 
declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\Register;

class RegisterService
{
    public function registerUser(array $data): Register
    {
        // Create a new user record in the database
      return Register::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? 'user',
        ]);

    }
}
