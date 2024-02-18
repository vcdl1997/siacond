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

    public static function build() :User
    {
        return new User();
    }

    public function username(mixed $username) :User
    {
        $this->setUsername($username ?? "");
        return $this;
    }

    public function password(mixed $password) :User
    {
        $this->setPassword($password ?? "");
        return $this;
    }

    public function active(mixed $active) :User
    {
        $this->setActive($active ?? true);
        return $this;
    }

    public function getId() :int
    {
    	return $this->id;
    }

    public function setId(int $id) :void
    {
    	$this->id = $id;
    }

    public function getUsername() :string
    {
    	return $this->username;
    }

    public function setUsername(string $username) :void
    {
        if(!$this->validateUsername($username)){
            throw new Exception(UserRule::getMessage('INVALID_USERNAME'));
        }

    	$this->username = $username;
    }

    private function validateUsername(string $username) :bool
    {
        $allowedSize = strlen($username) >= 3 && strlen($username) <= 320;
        $checkIfEmailInString = Text::checkIfEmailInString($username);
        $emailIsValid = $checkIfEmailInString ? filter_var($username, FILTER_VALIDATE_EMAIL) : true; 

        return $allowedSize && $emailIsValid;
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
            throw new InvalidArgumentException(UserRule::getMessage('INVALID_PASSWORD'));
        }

        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function validatePassword(string $password) :bool
    {
        $allowedSize = strlen($password) >= 8 || strlen($password) <= 100;
        $containsLetters = preg_match("/[a-zA-Z]+/", $password);
        $containsNumbers = preg_match("/\d/", $password);
        $containsSpecialCharacters = preg_match("/[`!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?~]/", $password);

        return $allowedSize && $containsLetters && $containsNumbers && $containsSpecialCharacters;
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

    public function getFillableFields() :array
    {
        return [
            self::USERNAME => 'getUsername',
            self::PASSWORD => 'getPassword'
        ];
    }

    public function getMutableFields() :array
    {
        return [
            self::PASSWORD => 'getPassword',
            self::ACTIVE => 'getActive'
        ];
    }
}