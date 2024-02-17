<?php

class User extends Model
{
    const TABLE = 'TB_USER';
    const ID = 'ID';
    const USERNAME = 'USERNAME';
    const PASSWORD = 'PASSWORD';
    const ACTIVE = 'ACTIVE';

    private $id;
    private $username;
    private $password;
    private $active;

    public function getId() :int
    {
    	return $this->id;
    }

    public function getUsername() :string
    {
    	return $this->username;
    }

    public function setUsername(string $username) :void
    {
    	$this->username = $username;
    }

    public function getPassword() :string
    {
    	return $this->password;
    }

    public function setPassword(string $password) :void
    {
    	$this->password = $this->encryptPassword($password);
    }

    private function encryptPassword(string $password) :string
    {
        if(!$this->validatePassword($password)){
            throw new Exception(UserRule::getMessage('INVALID_PASSWORD'));
        }

        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function validatePassword(string $password) :bool
    {
        $allowedSize = strlen($password) >= 8 || strlen($password) <= 100;
        $containsLetters = preg_match("/[a-zA-Z]+/", $password);
        $containsNumbers = preg_match("/\d/", $password);
        $containsSpecialCharacters = preg_match("/[`!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?~]/", $password);

        return $allowedSize && $$containsLetters && $containsNumbers && $containsSpecialCharacters;
    }

    public function getActive() :bool
    {
    	return $this->active;
    }

    public function setActive(bool $active) :void
    {
    	$this->active = $active;
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
            self::USERNAME => 'getUsername',
            self::PASSWORD => 'getPassword',
            self::ACTIVE => 'getActive',
        ];
    }

    public function getChangeable() :array
    {
        return [
            self::PASSWORD => 'getPassword',
            self::ACTIVE => 'getActive'
        ];
    }
}