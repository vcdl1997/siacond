<?php

class SystemLogRepository extends Repository
{
    protected $model;

    function __construct(SystemLog $model)
    {
        parent::__construct($model);
    }
}