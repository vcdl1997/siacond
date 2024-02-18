<?php

class Employee extends PersonBase
{
    const TABLE = 'TB_EMPLOYEE';
    const ID = 'ID';
    const REGISTRATION_CODE = 'REGISTRATION_CODE';
    const REGISTERED_BIOMETRICS = 'REGISTERED_BIOMETRICS';
    const ACTIVE = 'ACTIVE';  

    private $id;
    private $registrationCode;
    private $registeredBiometrics;
    private $active;
    
    public static function build() :Employee
    {
        return new Employee();
    }

    public function registrationCode(mixed $registrationCode = null) :Employee
    {
        $this->setRegistrationCode($registrationCode ?? "");
        return $this;
    }

    public function registeredBiometrics(mixed $registeredBiometrics = null) :Employee
    {
        $this->setRegisteredBiometrics($registeredBiometrics ?? "");
        return $this;
    }

    public function active(mixed $active = null) :Employee
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

    public function getRegistrationCode() :string
    {
    	return $this->registrationCode;
    }

    public function setRegistrationCode(string $registrationCode) :void
    {
    	$this->registrationCode = $registrationCode;
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
            self::REGISTRATION_CODE => 'getRegistrationCode',
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
            self::REGISTRATION_CODE => 'getRegistrationCode',
            self::REGISTERED_BIOMETRICS => 'getRegisteredBiometrics',
            self::ACTIVE => 'getActive'
        ];
    }

    public function toString() :string
    {
        return json_encode(get_object_vars($this));
    }
}