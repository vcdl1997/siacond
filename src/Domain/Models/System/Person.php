<?php

class Person extends Model
{
    const TABLE = 'TB_PERSON';
    const ID = 'ID';
    const FIRSTNAME = 'FIRSTNAME';
    const LASTNAME = 'LASTNAME';
    const BIRTHDATE = 'BIRTHDATE';
    const USER_ID = 'USER_ID';

    private $id;
    private $firstname;
    private $lastname;
    private $birthdate;
    private $userId;

    
    public function getId() :int
    {
    	return $this->id;
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
    	return $this->lastname;
    }

    public function setLastname(string $lastname) 
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

    public function getTable() :string
    {
        return self::TABLE;
    }

    public function getPrimaryKey() :mixed
    {
        return self::ID;
    }

    public function getFillable() :array
    {
        return [
            self::FIRSTNAME => 'getFirstname',
            self::LASTNAME => 'getLastname',
            self::BIRTHDATE => 'getBirthdate',
            self::USER_ID => 'getUserId'
        ];
    }

    public function getChangeable() :array
    {
        return [
            self::FIRSTNAME => 'getFirstname',
            self::LASTNAME => 'getLastname'
        ];
    }
}