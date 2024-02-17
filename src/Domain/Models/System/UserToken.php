<?php

class UserToken extends Model
{
    const TABLE = 'TB_USER_TOKEN';
    const ID = 'ID';
    const USER_ID = 'USER_ID';
    const TOKEN = 'TOKEN';
    
    private $id;
    private $userId;
    private $token;

    public function getId() :int
    {
    	return $this->id;
    }

    public function getUserId() :int
    {
    	return $this->userId;
    }

    public function setUserId(int $userId) :void
    {
    	$this->userId = $userId;
    }

    public function getToken() :string
    {
    	return $this->token;
    }

    public function setToken(string $token) :void
    {
    	$this->token = $token;
    }

    public function getTable() :string
    {
        return self::TABLE;
    }

    public function getPrimaryKey() :mixed
    {
        return [
            self::ID
        ];
    }

    public function getFillable() :array
    {
        return [
            self::USER_ID => 'getUserId',
            self::TOKEN => 'getToken'
        ];
    }

    public function getChangeable() :array
    {
        return [];
    }
}