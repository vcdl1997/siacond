<?php

abstract class PersonBase extends Model
{
    const NATIONAL_IDENTIFIER_CODE = 'NATIONAL_IDENTIFIER_CODE';
    const FIRSTNAME = 'FIRSTNAME';
    const LASTNAME = 'LASTNAME';
    const BIRTHDATE = 'BIRTHDATE';
    const USER_ID = 'USER_ID';

    const MINIMUM_SIZE_FIRSTNAME = 3;
    const MAXIMUM_SIZE_FIRSTNAME = 100;
    const MINIMUM_SIZE_LASTNAME = 3;
    const MAXIMUM_SIZE_LASTNAME = 200;
    const MINIMUM_AGE_TO_USE_THE_SYSTEM = 14;

    protected $nationalIdentifierCode;
    protected $firstname;
    protected $lastname;
    protected $birthdate;
    protected $userId;
    
    public function nationalIdentifierCode(mixed $nationalIdentifierCode = null) :mixed
    {
        $this->setNationalIdentifierCode($nationalIdentifierCode ?? "");
        return $this;
    }

    public function firstname(mixed $firstname = null) :mixed
    {
        $this->setFirstname($firstname ?? "");
        return $this;
    }

    public function lastname(mixed $lastname = null) :mixed
    {
        $this->setLastname($lastname ?? "");
        return $this;
    }

    public function birthdate(mixed $birthdate = null) :mixed
    {
        $this->setBirthdate($birthdate ?? "");
        return $this;
    }

    public function userId(mixed $userId = null) :mixed
    {
        $this->setUserId($userId ?? 0);
        return $this;
    }

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
        if(strlen(trim($firstname)) < self::MINIMUM_SIZE_FIRSTNAME || strlen(trim($firstname)) > self::MAXIMUM_SIZE_FIRSTNAME){
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
        if(strlen(trim($lastname)) < self::MINIMUM_SIZE_LASTNAME || strlen(trim($lastname)) > self::MAXIMUM_SIZE_LASTNAME){
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
            throw new InvalidArgumentException(PersonRule::getMessage('DOES_NOT_EXIST_OR_HAS_NO_MINIMUM_AGE'));
        }

    	$this->birthdate = $birthdate;
    }

    private function validateBirthdate(string $birthdate) :bool
    {
        $pattern = "/[0-9]{4}-[0-9]{2}-[0-9]{2}/";

        if(!preg_match($pattern, $birthdate)){
            throw new InvalidArgumentException(PersonRule::getMessage('INVALID_BIRTHDATE'));
        }

        $dateExists = Calendar::dateExists($birthdate);
        $haveAMinimumAge = Calendar::getDifferenceInYears($birthdate) >= self::MINIMUM_AGE_TO_USE_THE_SYSTEM;

        return $dateExists && $haveAMinimumAge;
    }

    public function getUserId() :int
    {
    	return $this->userId;
    }

    public function setUserId(int $userId) :void
    {
        if($userId < self::MINIMUM_LIMIT_BIGINT || $userId > self::MAXIMUM_LIMIT_BIGINT){
            throw new BusinessException(PersonRule::getMessage('INVALID_USER'));
        }

    	$this->userId = $userId;
    }
}