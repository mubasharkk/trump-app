<?php

namespace App\Services\Dto;

final class DisplayName
{
    private $firstName;
    private $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function __toString(): string
    {
        return implode(' ', [
            $this->firstName(),
            $this->lastName()
        ]);
    }
}