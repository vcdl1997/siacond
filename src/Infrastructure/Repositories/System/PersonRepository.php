<?php

class PersonRepository extends Repository
{
    protected $model;

    function __construct(Person $model)
    {
        parent::__construct($model);
    }
}