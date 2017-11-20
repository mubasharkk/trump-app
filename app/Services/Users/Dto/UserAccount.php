<?php

namespace App\Services\Dto;

use Carbon\Carbon;

final class UserAccount
{
    private $id;
    private $username;
    private $email;
    private $displayName;
    private $pictureUrl;
    private $platforms = [];
    private $createdAt;
    private $lastLoginAt;

    public function __construct(
        string $id,
        string $username,
        string $email,
        DisplayName $displayName,
        Carbon $createdAt,
        string $pictureUrl = null,
        Carbon $lastLoginAt = null
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->displayName = $displayName;
        $this->pictureUrl = $pictureUrl;
        $this->createdAt = $createdAt;
        $this->lastLoginAt = $lastLoginAt;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function name(): DisplayName
    {
        return $this->displayName;
    }

    public function picture(): string
    {
        return $this->pictureUrl;
    }

    public function createdAt(): Carbon
    {
        return $this->createdAt;
    }

    public function lastLoginAt(): Carbon
    {
        return $this->lastLoginAt;
    }

    public function addPlatform(string $driver, string $userId, string $username, string $token)
    {
        $this->platforms[$driver] = new AuthPlatform($driver, $userId, $username, $token);
    }

    public function getPlatform(string $driver): AuthPlatform
    {
        return isset($this->platforms[$driver]) ? $this->platforms[$driver] : null;
    }

    public function isAuthenticatedWith(string $driver): bool
    {
        return isset($this->platforms[$driver]);
    }

    public function getAuthPlatforms(): array
    {
        return $this->platforms;
    }

    public function email(): string
    {
        return $this->email;
    }
}