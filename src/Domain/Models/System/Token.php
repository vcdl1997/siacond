<?php

class Token extends Model
{
    const TABLE = 'token';
    const USER_ID = 'user_id';
    const HASH = 'hash';
    
    private $userId;
    private $hash;

    public function getUserId() {
    	return $this->userId;
    }

    public function setUserId($userId) {
    	$this->userId = $userId;
    }

    public function getHash() {
    	return $this->hash;
    }

    public function setHash($hash) 
    {
    	$this->hash = $hash;
    }

    public function __toString() :string
    {
    	return "UserId: {$this->userId}, Hash: {$this->hash}";
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