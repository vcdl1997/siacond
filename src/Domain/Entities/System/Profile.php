<?php

class Profile extends Model
{
    const TABLE = 'TB_PROFILE';
    const ID = 'ID';
    const DESCRIPTION = 'DESCRIPTION';
    const CONSTANT = 'CONSTANT';

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
        if(strlen($description) == 0 || strlen($description) > 1000){
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
}