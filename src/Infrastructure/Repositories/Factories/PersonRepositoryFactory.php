<?php

class PersonRepositoryFactory
{
    public static function getRepository(string $typeOfPerson = '', PDO $conn) :PersonRepository
    {
        if(!in_array($typeOfPerson, [PersonBase::RESIDENT, PersonBase::EMPLOYEE])){
            throw new BusinessException(PersonRule::getMessage('INVALID_PERSON_TYPE'));
        }

        switch($typeOfPerson){
            case PersonBase::RESIDENT: 
                return new ResidentRepository(null, $conn);

            case PersonBase::EMPLOYEE:
                return new EmployeeRepository(null, $conn);
        }
    }
}