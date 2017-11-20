<?php

namespace App\Services\Dto;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

final class AuthPlatform implements JsonSerializable, Arrayable
{
    private $driver;
    private $userId;
    private $username;
    private $token;

    public function __construct(string $driver, string $userId, string $username, string $token)
    {
        $this->driver = $driver;
        $this->userId = $userId;
        $this->username = $username;
        $this->token = $token;
    }

    public function driver():string
    {
        return $this->driver;
    }

    public function id()
    {
        return $this->userId;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'driver' => $this->driver(),
            'token' => $this->token(),
            'username' => $this->username()
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}