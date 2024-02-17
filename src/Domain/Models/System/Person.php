<?php

class Person extends Model
{
    const TABLE = 'tb_person';
    const ID = 'id';
    const FIRSTNAME = 'firstname';
    const LASTNAME = 'lastname';
    const BIRTHDATE = 'birthdate';
    const USER_ID = 'user_id';

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

    public function setFirstname($firstname) :void
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

    public function getUserId() :int
    {
    	return $this->userId;
    }

    public function setUserId($userId) :void
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
            self::FIRSTNAME,
            self::LASTNAME,
            self::BIRTHDATE,
            self::USER_ID
        ];
    }

    public function getChangeable() :array
    {
        return [
            self::FIRSTNAME,
            self::LASTNAME,
            self::BIRTHDATE
        ];
    }
}