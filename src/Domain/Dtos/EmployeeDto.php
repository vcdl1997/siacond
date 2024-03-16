<?php

class EmployeeDto extends PersonBaseDto
{
    private $registrationCode;
    private $registeredBiometrics;
    private $active;

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
}