<?php

class Resident extends PersonBase
{
    const TABLE = 'TB_RESIDENT';
    const ID = 'ID';
    const REGISTERED_BIOMETRICS = 'REGISTERED_BIOMETRICS';
    const ACTIVE = 'ACTIVE';  

    private $id;
    private $registeredBiometrics;
    private $active;
    
    public static function build() :Resident
    {
        return new Resident();
    }

    public function registeredBiometrics(mixed $registeredBiometrics) :Resident
    {
        $this->setRegisteredBiometrics($registeredBiometrics ?? false);
        return $this;
    }

    public function active(mixed $active) :Resident
    {
        $this->setActive($active ?? true);
        return $this;
    }

    public function getId() :int
    {
    	return $this->id;
    }

    public function setId(int $id) :void
    {
    	$this->id = $id;
    }

    public function getRegisteredBiometrics() :bool
    {
    	return $this->registeredBiometrics;
    }

    public function setRegisteredBiometrics(bool $registeredBiometrics) :void
    {
    	$this->registeredBiometrics = $registeredBiometrics;
    }

    public function getActive() :bool
    {
    	return $this->active;
    }

    public function setActive(bool $active) :void
    {
    	$this->active = $active;
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
            self::NATIONAL_IDENTIFIER_CODE => 'getNationalIdentifierCode',
            self::FIRSTNAME => 'getFirstname',
            self::LASTNAME => 'getLastname',
            self::BIRTHDATE => 'getBirthdate',
            self::REGISTERED_BIOMETRICS => 'getRegisteredBiometrics',
            self::ACTIVE => 'getActive',
            self::USER_ID => 'getUserId'
        ];
    }

    public function getMutableFields() :array
    {
        return [
            self::FIRSTNAME => 'getFirstname',
            self::LASTNAME => 'getLastname',
            self::REGISTERED_BIOMETRICS => 'getRegisteredBiometrics',
            self::ACTIVE => 'getActive'
        ];
    }

    public function toString() :string
    {
        return json_encode(get_object_vars($this));
    }
}