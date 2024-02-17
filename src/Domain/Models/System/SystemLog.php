<?php

class SystemLog extends Model
{
    const TABLE = 'TB_SYSTEM_LOG';
    const ID = 'ID';
    const MESSAGE = 'MESSAGE';

    private $id;
    private $message;

    public function getId() :int
    {
    	return $this->id;
    }

    public function getMessage() :string
    {
    	return $this->message;
    }

    public function setMessage(string $message) :void
    {
    	$this->message = $message;
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
            self::MESSAGE,
        ];
    }

    public function getChangeable() :array
    {
        return [];
    }
}