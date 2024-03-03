<?php

class UserRepository extends Repository
{
    function __construct(User $model = new User())
    {
        parent::__construct($model);
    }

    public function existsUsersWithThisUsername(string $username) :bool
    {
        $sql = "
            SELECT 
                COUNT(*) as existing_users 
            FROM " . User::TABLE . " as user
            WHERE user." . User::USERNAME . " = :" . User::USERNAME . "
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":" . User::USERNAME => $username]);
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
            FROM " . User::TABLE . " AS user
            WHERE user." . User::USERNAME . " = :" . User::USERNAME . "
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":" . User::USERNAME => $username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        
        return $stmt->fetch();
    }

    public function getByUsernameAndTypeOfPersonAndThatIsRelatedToCondominiums(string $username, string $typeOfPerson) :mixed
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
            FROM " . User::TABLE . " AS user
            " . $join[$typeOfPerson] ."
            WHERE user." . User::USERNAME . " = :" . User::USERNAME . " 
            AND user." . User::ACTIVE . " = :" . User::ACTIVE . " 
            AND EXISTS (
                SELECT 
                    " . UserCondominium::USER_ID . " 
                FROM " . UserCondominium::TABLE . " as user_condominium 
                WHERE user_condominium." . UserCondominium::USER_ID . " = user." . User::ID . "
                AND user_condominium." . UserCondominium::ACTIVE . " = :" . UserCondominium::ACTIVE . "
            )
        ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":" . User::USERNAME => $username,
            ":" . User::ACTIVE => true
        ]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        
        return $stmt->fetch();
    }
}