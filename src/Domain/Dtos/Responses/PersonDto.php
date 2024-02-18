<?php

class PersonDto
{
    private $userId;
    private $username;
    private $firstname;
    private $lastname;
    private $birthdate;

    public function getUserId() :int
    {
        return $this->userId;
    }

    public function setUserId(int $userId) :void
    {
        $this->userId = $userId;
    }

    public function getUsername() :int
    {
        return $this->userId;
    }

    public function setUsername(string $username) :void
    {
        $this->username = $username;
    }

    public function getFirstname() :string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname) :void
    {
        $this->firstname = $firstname;
    }

    public function getLastname() :string
    {
        return $this->firstname;
    }

    public function setLastname(string $lastname) :void
    {
        $this->lastname = $lastname;
    }

    public function getBirthdate() :string
    {
        return $this->birthdate;
    }

    public function setBirthdate(string $birthdate) :void
    {
        $this->birthdate = $birthdate;
    }
}