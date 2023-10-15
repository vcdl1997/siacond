<?php

class UserProfile extends Model
{
    const TABLE = 'user_profile';
    const ID_USER = 'id_user';
    const ID_PROFILE = 'id_profile';
    
    private $idUser;
    private $idProfile;

    public function getIdUser() {
    	return $this->idUser;
    }

    /**
    * @param $idUser
    */
    public function setIdUser($idUser) {
    	$this->idUser = $idUser;
    }

    public function getIdProfile() {
    	return $this->idProfile;
    }

    /**
    * @param $idProfile
    */
    public function setIdProfile($idProfile) {
    	$this->idProfile = $idProfile;
    }

    public function __toString() {
    	return "IdUser: {$this->idUser}, IdProfile: {$this->idProfile}";
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