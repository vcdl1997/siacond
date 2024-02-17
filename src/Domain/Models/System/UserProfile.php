<?php

class UserProfile extends Model
{
    const TABLE = 'TB_USER_PROFILE';
    const USER_ID = 'USER_ID';
    const PROFILE_ID = 'PROFILE_ID';
    
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

    public function getProfileId() :int
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
            self::USER_ID,
            self::PROFILE_ID
        ];
    }
    
    public function getFillable() :array
    {
        return [
            self::USER_ID => 'getUserId',
            self::PROFILE_ID => 'getProfileId'
        ];
    }

    public function getChangeable() :array
    {
        return [];
    }
}