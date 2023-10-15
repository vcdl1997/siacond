<?php

class Person extends Model
{
    const TABLE = 'person';
    const ID = 'id';
    const FIRSTNAME = 'firstname';
    const EMAIL = 'email';
    const USER_ID = 'user_id';

    private $id;
    private $firstname;
    private $email;
    private $userId;

    
    public function getId() {
    	return $this->id;
    }

    /**
    * @param $id
    */
    public function setId($id) {
    	$this->id = $id;
    }

    public function getFirstname() {
    	return $this->firstname;
    }

    /**
    * @param $firstname
    */
    public function setFirstname($firstname) {
    	$this->firstname = $firstname;
    }

    public function getEmail() {
    	return $this->email;
    }

    /**
    * @param $email
    */
    public function setEmail($email) {
    	$this->email = $email;
    }

    public function getUserId() {
    	return $this->userId;
    }

    /**
    * @param $userId
    */
    public function setUserId($userId) {
    	$this->userId = $userId;
    }
    
    public function __toString() :string
    {
    	return "Id: {$this->id}, Firstname: {$this->firstname}, Email: {$this->email}, UserId: {$this->userId}";
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
            self::EMAIL,
            self::USER_ID
        ];
    }

    public function getChangeable() :array
    {
        return [
            self::FIRSTNAME,
            self::EMAIL,
            self::USER_ID
        ];
    }
}