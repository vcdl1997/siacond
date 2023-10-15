<?php

abstract class Model implements IModel
{ 
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $created_at;
    protected $updated_at;

    public function getCreated_at() {
    	return $this->created_at;
    }

    public function getUpdated_at() {
    	return $this->updated_at;
    }
}

interface IModel
{
    public function getTable() :string;
    public function getPrimaryKey() :mixed;
    public function getFillable() :array;
    public function getChangeable() :array;
}