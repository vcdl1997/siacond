<?php

class UserToken extends Model
{
    const TABLE = 'tb_token';
    const USER_ID = 'user_id';
    const HASH = 'hash';
    
    private $userId;
    private $hash;

    public function getUserId() :int
    {
    	return $this->userId;
    }

    public function setUserId(int $userId) :void
    {
    	$this->userId = $userId;
    }

    public function getHash() :string
    {
    	return $this->hash;
    }

    public function setHash(string $hash) :void
    {
    	$this->hash = $hash;
    }

    public function getTable() :string
    {
        return self::TABLE;
    }

    public function getPrimaryKey() :mixed
    {
        return [
            self::USER_ID,
            self::HASH
        ];
    }

    public function getFillable() :array
    {
        return [
            self::USER_ID,
            self::HASH
        ];
    }

    public function getChangeable() :array
    {
        return [];
    }
}