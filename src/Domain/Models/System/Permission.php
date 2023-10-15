<?php

class Permission extends Model
{
    const TABLE = 'permission';
    const ID = 'id';
    const DESCRIPTION = 'description';
    const PROFILE_ID = 'profile_id';
    const CONSTANT = 'constant';

    private $id;
    private $description;
    private $constant;
    private $profileId;

    public function getId() {
    	return $this->id;
    }

    /**
    * @param $id
    */
    public function setId($id) {
    	$this->id = $id;
    }

    public function getDescription() {
    	return $this->description;
    }

    /**
    * @param $description
    */
    public function setDescription($description) {
    	$this->description = $description;
    }

    public function getConstant() {
    	return $this->constant;
    }

    /**
    * @param $constant
    */
    public function setConstant($constant) {
    	$this->constant = $constant;
    }

    public function getProfileId() {
    	return $this->profileId;
    }

    /**
    * @param $profileId
    */
    public function setProfileId($profileId) {
    	$this->profileId = $profileId;
    }

    public function __toString() :string
    {
    	return "Id: {$this->id}, Description: {$this->description}, Constant: {$this->constant}, ProfileId: {$this->profileId}";
    }

    public function getTable() :string
    {
        return self::TABLE;
    }

    public function getPrimaryKey() :mixed
    {
        return self::ID;
    }

    public function getFillable() :array
    {
        return [
            self::DESCRIPTION,
            self::CONSTANT,
            self::PROFILE_ID
        ];
    }

    public function getChangeable() :array
    {
        return [
            self::DESCRIPTION,
            self::PROFILE_ID
        ];
    }
}