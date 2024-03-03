<?php

class UserCondominium extends Model
{
    const TABLE = 'TB_USER_CONDOMINIUM';
    const USER_ID = 'USER_ID';
    const CONDOMINIUM_ID = 'CONDOMINIUM_ID';
    const ACTIVE = 'ACTIVE';
    
    private $userId;
    private $condominiumId;

    public function getUserId() :int
    {
    	return $this->userId;
    }

    public function setUserId(int $userId) :void
    {
    	$this->userId = $userId;
    }

    public function getCondominiumId() :int
    {
    	return $this->condominiumId;
    }

    public function setCondominiumId(int $condominiumId) :void
    {
    	$this->condominiumId = $condominiumId;
    }

    public function getTable() :string
    {
        return self::TABLE;
    }

    public function getPrimaryKey() :mixed
    {
        return [
            self::USER_ID,
            self::CONDOMINIUM_ID
        ];
    }
    
    public function getFillableFields() :array
    {
        return [
            self::USER_ID => 'getUserId',
            self::CONDOMINIUM_ID => 'getCondominiumId'
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