<?php

class PersonFactory
{
    const RESIDENT = '1';
    const EMPLOYEE =  '2';

    public static function createPerson(array $data = []) :PersonBase
    {
        $typeOfPerson = Request::data_get($data, 'typeOfPerson');

        if(!in_array($typeOfPerson, [self::RESIDENT, self::EMPLOYEE])){
            throw new BusinessException(PersonRule::getMessage('INVALID_PERSON_TYPE'));
        }

        switch($typeOfPerson){
            case self::RESIDENT:
                return Resident::build()
                    ->nationalIdentifierCode(Request::data_get($data, 'nationalIdentifierCode'))
                    ->firstname(Request::data_get($data, 'firstname'))
                    ->lastname(Request::data_get($data, 'lastname'))
                    ->birthdate(Request::data_get($data, 'birthdate'))
                    ->registeredBiometrics(Request::data_get($data, 'birthdate'))
                    ->active()
                ;

            case self::EMPLOYEE:
                return Employee::build()
                    ->nationalIdentifierCode(Request::data_get($data, 'nationalIdentifierCode'))
                    ->registrationCode(Request::data_get($data, 'registrationCode'))
                    ->firstname(Request::data_get($data, 'firstname'))
                    ->lastname(Request::data_get($data, 'lastname'))
                    ->birthdate(Request::data_get($data, 'birthdate'))
                    ->registeredBiometrics(Request::data_get($data, 'birthdate'))
                    ->active()
                ;
        }
    }
}