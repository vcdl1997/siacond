<?php

class ResidentDto extends PersonBaseDto
{
    private $registeredBiometrics;
    private $active;

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