<?php
declare(strict_types=1);

namespace App\DTO;
class UserDTO extends AbstractDTO
{
     private array $_toArrayData = [];

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public int $role,
        public ?string $token,
        public ?string $token_type
    )
    {
    }
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'token' => $this->token,
            'role' => $this->role,
            'token_type' => $this->token_type

        ];
    }
}
