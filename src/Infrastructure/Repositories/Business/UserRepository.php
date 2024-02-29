<?php

class UserRepository extends Repository
{
    function __construct(User $model = new User())
    {
        parent::__construct($model);
    }

    public function existsUsersWithThisUsername(string $username) :bool
    {
        $sql = "SELECT COUNT(*) as existing_users FROM " . $this->model->getTable() . " WHERE USERNAME = :USERNAME";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":USERNAME" => $username]);
        $result = $stmt->fetch(PDO::FETCH_LAZY);

        return $result->existing_users > 0;
    }

    public function getByUsername(string $username) :User
    {
        $sql = "
            SELECT 
                user." . User::ID . " AS id,
                user." . User::USERNAME . " AS username,
                user." . User::PASSWORD . " AS password,
                user." . User::ACTIVE . " AS active 
            FROM " . $this->model->getTable() . " AS user
            WHERE USERNAME = :USERNAME
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":USERNAME" => $username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        
        return $stmt->fetch();
    }

    public function getByUsernameAndTypeOfPerson(string $username, string $typeOfPerson) :mixed
    {        
        $join = [
            PersonBase::RESIDENT => "INNER JOIN " . Resident::TABLE . " AS resident ON resident." . Resident::USER_ID . " = user." . User::ID,
            PersonBase::EMPLOYEE => "INNER JOIN " . Employee::TABLE . " AS employee ON employee." . Employee::USER_ID . " = user." . User::ID
        ];
        
        $sql = "
            SELECT 
                user." . User::ID . " AS id,
                user." . User::USERNAME . " AS username,
                user." . User::PASSWORD . " AS password,
                user." . User::ACTIVE . " AS active 
            FROM " . $this->model->getTable() . " AS user
            " . $join[$typeOfPerson] ."
            WHERE USERNAME = :USERNAME 
        ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":USERNAME" => $username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        
        return $stmt->fetch();
    }
}