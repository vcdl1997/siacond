<?php

abstract class PersonRepository extends Repository implements IPersonRepository
{
    function __construct(PersonBase $model)
    {
        parent::__construct($model);
    }
}

interface IPersonRepository 
{
    public function getByUserId(int $userId) :PersonBaseDto;
}