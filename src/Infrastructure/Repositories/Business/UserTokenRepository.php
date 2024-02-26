<?php

class UserTokenRepository extends Repository
{
    function __construct(UserToken $model = new UserToken())
    {
        parent::__construct($model);
    }

    public function getUserByToken(string $token) :UserDto
    {
        $sql = "
            SELECT 
                user." . User::ID . " AS id,
                user." . User::USERNAME . " AS username
            FROM " . User::TABLE . " AS user
            INNER JOIN " . UserToken::TABLE . " AS user_token ON user_token." . UserToken::USER_ID . " = user." . User::ID . "
            WHERE user_token.". UserToken::TOKEN ." = :". UserToken::TOKEN
        ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":". UserToken::TOKEN => $token]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'UserDto');
        
        return $stmt->fetch();
    }
}