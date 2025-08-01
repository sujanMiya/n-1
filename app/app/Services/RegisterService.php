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
        $this->createTokenResponse($user);
        return $user;

    }
        /**
     * Create token response with 1-minute expiration
     */
    private function createTokenResponse($user): array
    {
        // Create token with 1-minute expiration
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        
        // Set token expiration to 1 minute from now
        $token->expires_at = Carbon::now()->addMinute();
        $token->save();

        return [
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'refresh_token' => $token->id,
            'token_type' => 'Bearer',
            'expires_at' => $token->expires_at->toISOString(),
            'expires_in' => 60, // 1 minute in seconds
        ];
    }
}
