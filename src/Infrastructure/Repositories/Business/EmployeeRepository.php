<?php

class EmployeeRepository extends PersonRepository
{
    function __construct(Employee $model = new Employee())
    {
        parent::__construct($model);
    }

    public function getByUserId(int $userId) :EmployeeDto
    {
        $sql = "
            SELECT 
                user." . User::ID . " as userId,
                user." . User::USERNAME . " as username,
                employee." . Employee::NATIONAL_IDENTIFIER_CODE . " as nationalIdentifierCode,
                employee." . Employee::REGISTRATION_CODE . " as registrationCode,
                employee." . Employee::FIRSTNAME . " as firstname,
                employee." . Employee::LASTNAME . " as lastname,
                employee." . Employee::BIRTHDATE . " as birthdate,
                employee." . Employee::REGISTERED_BIOMETRICS . " as registeredBiometrics,
                employee." . Employee::ACTIVE . " as active
            FROM " . User::TABLE . " AS user
            INNER JOIN " . Employee::TABLE  . " AS employee ON employee." . Employee::USER_ID . " = user." . User::ID . "
            WHERE user." . User::ID . " = :" . User::ID . "
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":" . User::ID => $userId]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'EmployeeDto');
        
        return $stmt->fetch();
    }
}