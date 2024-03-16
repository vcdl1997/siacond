<?php

abstract class PersonRepository extends Repository implements IPersonRepository
{
    function __construct(
        PersonBase $model,
        PDO $conn = null
    )
    {
        parent::__construct($model, $conn);
    }
}

interface IPersonRepository 
{
    public function getByUserId(int $userId) :PersonBaseDto;
}