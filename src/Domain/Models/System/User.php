<?php

class User extends Model
{
    const TABLE = 'user';
    const ID = 'id';
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const ACTIVE = 'active';

    private $id;
    private $username;
    private $password;
    private $active;

    
    public function getId() {
    	return $this->id;
    }

    /**
    * @param $id
    */
    public function setId($id) {
    	$this->id = $id;
    }

    public function getUsername() {
    	return $this->username;
    }

    /**
    * @param $username
    */
    public function setUsername($username) {
    	$this->username = $username;
    }

    public function getPassword() {
    	return $this->password;
    }

    /**
    * @param $password
    */
    public function setPassword($password) {
    	$this->password = $password;
    }

    public function getActive() {
    	return $this->active;
    }

    /**
    * @param $active
    */
    public function setActive($active) {
    	$this->active = $active;
    }

    public function __toString() :string
    {
    	return "Id: {$this->id}, Username: {$this->username}, Password: {$this->password}, Active: {$this->active}";
    }

    public function getTable() :string
    {
        return self::TABLE;
    }

    public function getPrimaryKey() :mixed
    {
        return self::USER_ID;
    }

    public function getFillable() :array
    {
        return [
            self::USERNAME,
            self::PASSWORD,
            self::ACTIVE
        ];
    }

    public function getChangeable() :array
    {
        return [
            self::PASSWORD,
            self::ACTIVE
        ];
    }
}