<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthServices
{
    /**
     * Example method to demonstrate service functionality.
     */
    public function login(array $credentials): User
    {
        $email = $credentials['email'];
        $password = $credentials['password'];   
        
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            throw new \Exception('Invalid credentials', 401);
        }
        
        $user = Auth::user();
        $user['access_token'] = $user->createToken('auth_token')->accessToken;
        $user['token_type'] = 'Bearer';
        return $user;
    }
    public function logout()
    {
        if (!Auth::check()) {
            throw new \Exception('No authenticated user', 401);
        }
        $token = Auth::user()->token();
        dd($token);
        $token->revoke();
    }
}