<?php

abstract class PersonBaseDto extends BaseDto
{
    protected $nationalIdentifierCode;
    protected $firstname;
    protected $lastname;
    protected $birthdate;
    protected $userId;
    protected $username;

    public function getNationalIdentifierCode() :string
    {
        return $this->nationalIdentifierCode;
    }

    public function setNationalIdentifierCode(string $nationalIdentifierCode) :void
    {
        $this->nationalIdentifierCode = $nationalIdentifierCode;
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
}