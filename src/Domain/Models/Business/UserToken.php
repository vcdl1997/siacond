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

    public static function build() :UserToken
    {
    	return new UserToken();
    }

    public function userId(int $userId) :UserToken
    {
        $this->setUserId($userId);
    	return $this;
    }

    public function token(string $token) :UserToken
    {
        $this->setToken($token);
    	return $this;
    }

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

    public function getFillableFields() :array
    {
        return [
            self::USER_ID => 'getUserId',
            self::TOKEN => 'getToken'
        ];
    }

    public function getMutableFields() :array
    {
        return [];
    }

    public function toString() :string
    {
        return json_encode(get_object_vars($this));
    }
}