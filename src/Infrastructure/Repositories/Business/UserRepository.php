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
}