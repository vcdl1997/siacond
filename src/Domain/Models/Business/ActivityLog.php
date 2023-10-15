<?php

class ActivityLog extends Model
{
    const TABLE = 'activity_log';
    const ID = 'id';
    const MESSAGE = 'message';
    const CONDOMINIUM_ID = 'condominium_id';

    private $id;
    private $message;
    private $condominiumId;

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

    public function getCondominiumId() {
    	return $this->condominiumId;
    }

    /**
    * @param $condominiumId
    */
    public function setCondominiumId($condominiumId) {
    	$this->condominiumId = $condominiumId;
    }

    public function __toString() :string
    {
    	return "Message: {$this->message}, CondominiumId: {$this->condominiumId}";
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
            self::CONDOMINIUM_ID
        ];
    }

    public function getChangeable() :array
    {
        return [];
    }
}