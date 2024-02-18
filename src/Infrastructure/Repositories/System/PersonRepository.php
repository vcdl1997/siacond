<?php

class PersonRepository extends Repository
{
    function __construct(Person $model)
    {
        parent::__construct($model);
    }

    public function getByUserId(int $userId) :PersonDto
    {
        $sql = "
            SELECT 
                person." . Person::FIRSTNAME . " as firstname,
                person." . Person::LASTNAME . " as lastname,
                person." . Person::BIRTHDATE . " as birthdate,
                user." . User::ID . " as userId,
                user." . User::USERNAME . " as username
            FROM " . User::TABLE . " AS user
            INNER JOIN " . Person::TABLE  . " AS person ON person." . Person::USER_ID . " = user." . User::ID . "
            WHERE user." . User::ID . " = :" . User::ID . "
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":" . User::ID => $userId]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PersonDto');
        
        return $stmt->fetch();
    }
}