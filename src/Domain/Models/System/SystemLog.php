<?php

class SystemLog extends Model
{
    const TABLE = 'system_log';
    const ID = 'id';
    const MESSAGE = 'message';

    private $id;
    private $message;

    public function getId() {
    	return $this->id;
    }

    /**
    * @param $id
    */
    public function setId($id) {
    	$this->id = $id;
    }

    public function getMessage() {
    	return $this->message;
    }

    /**
    * @param $message
    */
    public function setMessage($message) {
    	$this->message = $message;
    }

    /**
     * @return string
     */
    public function __toString() {
    	return "Id: {$this->id}, Message: {$this->message}";
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