<?php

class ResidentRepository extends PersonRepository
{
    function __construct(
        Resident $model = null,
        PDO $conn = null
    )
    {
        parent::__construct(empty($model) ? new Resident() : $model, $conn);
    }

    public function getByUserId(int $userId) :ResidentDto
    {
        $sql = "
            SELECT 
                user." . User::ID . " as userId,
                user." . User::USERNAME . " as username,
                resident." . Resident::NATIONAL_IDENTIFIER_CODE . " as nationalIdentifierCode,
                resident." . Resident::FIRSTNAME . " as firstname,
                resident." . Resident::LASTNAME . " as lastname,
                resident." . Resident::BIRTHDATE . " as birthdate,
                resident." . Resident::REGISTERED_BIOMETRICS . " as registeredBiometrics,
                resident." . Resident::ACTIVE . " as active
            FROM " . User::TABLE . " AS user
            INNER JOIN " . Resident::TABLE  . " AS resident ON resident." . Resident::USER_ID . " = user." . User::ID . "
            WHERE user." . User::ID . " = :" . User::ID . "
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":" . User::ID => $userId]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ResidentDto');
        
        return $stmt->fetch();
    }
}