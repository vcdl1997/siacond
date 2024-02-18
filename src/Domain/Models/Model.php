<?php

abstract class Model implements IModel
{ 
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';
    const MINIMUM_LIMIT_BIGINT = 1;
    const MAXIMUM_LIMIT_BIGINT = 9223372036854775807; 

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
}

interface IModel
{
    public function getTable() :string;
    public function getPrimaryKey() :mixed;
    public function getFillableFields() :array;
    public function getMutableFields() :array;
    public function toString() :string;
}