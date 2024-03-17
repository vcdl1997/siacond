<?php

class UserTokenRepository extends Repository
{
    function __construct(
        UserToken $model = null,
        PDO $conn
    )
    {
        parent::__construct(empty($model) ? new UserToken() : $model, $conn);
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

    public function tokenExists(string $token) :bool
    {
        $sql = "
            SELECT 
                count(*) as exists_token
            FROM " . UserToken::TABLE . " AS user_token
            WHERE user_token.". UserToken::TOKEN . " = :" . UserToken::TOKEN . "
            AND user_token.". UserToken::ACTIVE . " = :" . UserToken::ACTIVE
        ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":" . UserToken::TOKEN => $token,
            ":" . UserToken::ACTIVE => true
        ]);
        $result = $stmt->fetch(PDO::FETCH_LAZY);

        return $result->exists_token == 1;
    }

    public function deleteByToken(string $token) :void
    {
        $sql = "
            DELETE FROM " . UserToken::TABLE . "
            WHERE ". UserToken::TOKEN . " = :" . UserToken::TOKEN
        ;
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":" . UserToken::TOKEN, $token);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            throw new DatabaseErrorException(SQLError::getMessage('UNSUCCESSFUL_COMMAND'));
        }
    }
}