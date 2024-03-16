<?php

class UserDto extends BaseDto
{
    private $id;
    private $username;

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
        $this->username = $username;
    }
}