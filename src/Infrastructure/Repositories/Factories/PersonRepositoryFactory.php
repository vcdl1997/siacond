<?php

class PersonRepositoryFactory
{
    public static function getRepository(string $typeOfPerson = '') :PersonRepository
    {
        if(!in_array($typeOfPerson, [PersonBase::RESIDENT, PersonBase::EMPLOYEE])){
            throw new BusinessException(PersonRule::getMessage('INVALID_PERSON_TYPE'));
        }

        switch($typeOfPerson){
            case PersonBase::RESIDENT: 
                return new ResidentRepository();

            case PersonBase::EMPLOYEE:
                return new EmployeeRepository();
        }
    }
}