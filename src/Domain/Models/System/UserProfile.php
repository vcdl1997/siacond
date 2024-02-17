<?php

class UserProfile extends Model
{
    const TABLE = 'TB_USER_PROFILE';
    const ID_USER = 'USER_ID';
    const ID_PROFILE = 'PROFILE_ID';
    
    private $userId;
    private $profileId;

    public function getUserId() :int
    {
    	return $this->userId;
    }

    public function setUserId(int $userId) :void
    {
    	$this->userId = $userId;
    }

    public function getIdProfile() :int
    {
    	return $this->profileId;
    }

    public function setProfileId(int $profileId) :void
    {
    	$this->profileId = $profileId;
    }

    public function getTable() :string
    {
        return self::TABLE;
    }

    public function getPrimaryKey() :mixed
    {
        return [
            self::ID_USER,
            self::ID_PROFILE
        ];
    }
    
    public function getFillable() :array
    {
        return [
            self::ID_USER,
            self::ID_PROFILE
        ];
    }

    public function getChangeable() :array
    {
        return [];
    }
}