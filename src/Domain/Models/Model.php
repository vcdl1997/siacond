<?php

abstract class Model implements IModel
{ 
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    const YEAR = 0;
    const MONTH = 1;
    const DAY = 2;
    const LIMIT_BIGINT_MYSQL = 9223372036854775807; 

    protected $created_at;
    protected $updated_at;

    public function getCreated_at() :string
    {
    	return $this->created_at;
    }

    public function getUpdated_at() :string
    {
    	return $this->updated_at;
    }

    public function __toString() :string
    {
        return json_encode(get_object_vars($this));
    }
}

interface IModel
{
    public function getTable() :string;
    public function getPrimaryKey() :mixed;
    public function getFillableFields() :array;
    public function getMutableFields() :array;
}