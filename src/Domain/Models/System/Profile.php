<?php

class Profile extends Model
{
    const TABLE = 'profile';
    const ID = 'id';
    const DESCRIPTION = 'description';
    const CONSTANT = 'constant';

    private $id;
    private $description;
    private $constant;

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

    public function __toString() :string
    {
    	return "Id: {$this->id}, Description: {$this->description}, Constant: {$this->constant}";
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
            self::CONSTANT
        ];
    }

    public function getChangeable() :array
    {
        return [
            self::DESCRIPTION,
        ];
    }
}