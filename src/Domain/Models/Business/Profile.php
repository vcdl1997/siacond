<?php

class Profile extends Model
{
    const TABLE = 'TB_PROFILE';
    const ID = 'ID';
    const DESCRIPTION = 'DESCRIPTION';
    const CONSTANT = 'CONSTANT';
    const MINIMUM_SIZE_DESCRIPTION = 3;
    const MAXIMUM_SIZE_DESCRIPTION = 1000;

    private $id;
    private $description;
    private $constant;

    public function getId() :int
    {
    	return $this->id;
    }

    public function getDescription() :string
    {
    	return $this->description;
    }

    public function setDescription(string $description) :void
    {
        if(strlen($description) < self::MINIMUM_SIZE_DESCRIPTION || strlen($description) > self::MAXIMUM_SIZE_DESCRIPTION){
            throw new Exception(ProfileRule::getMessage('MAXIMUM_SIZE_DESCRIPTION'));
        }

    	$this->description = $description;
    }

    public function getConstant() :string
    {
    	return $this->constant;
    }

    public function getTable() :string
    {
        return self::TABLE;
    }

    public function getPrimaryKey() :mixed
    {
        return self::ID;
    }

    public function getFillableFields() :array
    {
        return [
            self::DESCRIPTION => 'getDescription',
            self::CONSTANT => 'getConstant'
        ];
    }

    public function getMutableFields() :array
    {
        return [
            self::DESCRIPTION => 'getDescription'
        ];
    }

    public function toString() :string
    {
        return json_encode(get_object_vars($this));
    }
}