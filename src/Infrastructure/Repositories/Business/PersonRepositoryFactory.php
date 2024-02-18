<?php

class PersonRepositoryFactory
{
    const RESIDENT = '1';
    const EMPLOYEE =  '2';

    public static function getRepository(string $typeOfPerson = '') :PersonRepository
    {
        if(!in_array($typeOfPerson, [self::RESIDENT, self::EMPLOYEE])){
            throw new BusinessException(PersonRule::getMessage('INVALID_PERSON_TYPE'));
        }

        switch($typeOfPerson){
            case self::RESIDENT: 
                return new ResidentRepository();

            case self::EMPLOYEE:
                return new EmployeeRepository();
        }
    }
}