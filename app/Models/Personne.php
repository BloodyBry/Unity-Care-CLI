<?php

namespace App\Models;

abstract class Personne
{
    protected int $id;
    protected string $firstName;
    protected string $lastName;
    protected ?string $email;
    protected ?string $phone;

    public function __construct(
        string $firstName,
        string $lastName,
        ?string $email = null,
        ?string $phone = null,
        int $id = 0
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

    // Getters (needed later)
    public function getId(): int { return $this->id; }
    public function getFirstName(): string { return $this->firstName; }
    public function getLastName(): string { return $this->lastName; }
    public function getEmail(): ?string { return $this->email; }
    public function getPhone(): ?string { return $this->phone; }
}
