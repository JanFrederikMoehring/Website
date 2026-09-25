<?php

class User 
{
    private int $id;
    private string $email;
    private string $firstName;
    private string $lastName;
    private Address $address;

    public function __construct(string $email, string $firstName, string $lastName, Address $address)
    {
        $this->id = random_int(1, 1_000_000);
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
    }

    public function email(string $email): void
    {
        $this->email = $email;
    }

    public function __invoke(): string
    {
        return 'Hello ' . $this->firstName . ' ' . $this->lastName;
    }     
}