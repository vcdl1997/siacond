<?php

class Person extends Model
{
    const TABLE = 'TB_PERSON';
    const ID = 'ID';
    const FIRSTNAME = 'FIRSTNAME';
    const LASTNAME = 'LASTNAME';
    const BIRTHDATE = 'BIRTHDATE';
    const USER_ID = 'USER_ID';

    const MINIMUM_SIZE_FIRSTNAME = 3;
    const MAXIMUM_SIZE_FIRSTNAME = 100;
    const MINIMUM_SIZE_LASTNAME = 3;
    const MAXIMUM_SIZE_LASTNAME = 200;

    private $id;
    private $firstname;
    private $lastname;
    private $birthdate;
    private $userId;

    
    public static function build() :Person
    {
        return new Person();
    }

    public function firstname(mixed $firstname) :Person
    {
        $this->setFirstname($firstname ?? "");
        return $this;
    }

    public function lastname(mixed $lastname) :Person
    {
        $this->setLastname($lastname ?? "");
        return $this;
    }

    public function birthdate(mixed $birthdate) :Person
    {
        $this->setBirthdate($birthdate ?? "");
        return $this;
    }

    public function userId(mixed $userId) :Person
    {
        $this->setUserId($userId ?? 0);
        return $this;
    }

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
        if(!strlen($firstname) >= self::MINIMUM_SIZE_FIRSTNAME && !strlen($firstname) <= self::MAXIMUM_SIZE_FIRSTNAME){
            throw new InvalidArgumentException(PersonRule::getMessage('INVALID_FIRSTNAME'));
        }

    	$this->firstname = $firstname;
    }

    public function getLastname() :string
    {
    	return $this->lastname;
    }

    public function setLastname(string $lastname) 
    {
        if(!strlen($lastname) >= self::MINIMUM_SIZE_LASTNAME && !strlen($lastname) <= self::MAXIMUM_SIZE_LASTNAME){
            throw new InvalidArgumentException(PersonRule::getMessage('INVALID_LASTNAME'));
        }

    	$this->lastname = $lastname;
    }

    public function getBirthdate() :string
    {
    	return $this->birthdate;
    }

    public function setBirthdate(string $birthdate) :void
    {
        if(!$this->validateBirthdate($birthdate)){
            throw new InvalidArgumentException(PersonRule::getMessage('INVALID_BIRTHDATE'));
        }

    	$this->birthdate = $birthdate;
    }

    private function validateBirthdate(string $birthdate) :bool
    {
        $pattern = "/[0-9]{4}-[0-9]{2}-[0-9]{2}/";

        if(!preg_match($pattern, $birthdate)){
            throw new BusinessException(PersonRule::getMessage('INVALID_BIRTHDATE'));
        }

        $split_date = explode("-", $birthdate);

        return checkdate($split_date[self::MONTH], $split_date[self::DAY], $split_date[self::YEAR]);
    }

    public function getUserId() :int
    {
    	return $this->userId;
    }

    public function setUserId(int $userId) :void
    {
        if($userId == 0 || $userId > self::LIMIT_BIGINT_MYSQL){
            throw new BusinessException(PersonRule::getMessage('INVALID_USER'));
        }

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

    public function getFillableFields() :array
    {
        return [
            self::FIRSTNAME => 'getFirstname',
            self::LASTNAME => 'getLastname',
            self::BIRTHDATE => 'getBirthdate',
            self::USER_ID => 'getUserId'
        ];
    }

    public function getMutableFields() :array
    {
        return [
            self::FIRSTNAME => 'getFirstname',
            self::LASTNAME => 'getLastname'
        ];
    }
}