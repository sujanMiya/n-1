<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\UserDTO;
use App\Enums\UserRoleEnum;
use Arr;
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
        $user['access_token'] = $this->generateToken($user);
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

    public function registerUser(array $data): User
    {
        $userDto = $this->prepareCreateUserDTO($data);
        $user = $this->createUser($userDto);
        $user->access_token = $this->generateToken($user);
        return $user;
    }
    public function generateToken(User $user): string
    {
         return $user->createToken('auth_token')->plainTextToken;
    }
    public function createUser(UserDTO $userDto): User
    {
        return User::create($userDto->toArray());
    }
    public function prepareCreateUserDTO(array $data): UserDTO
    {
        return new UserDTO(
            name: Arr::get($data, 'name'),
            email: Arr::get($data, 'email'),
            password: bcrypt(Arr::get($data, 'password')),
            role: UserRoleEnum::USER->value,
            token: null,
            token_type: null
        );
    }
}
