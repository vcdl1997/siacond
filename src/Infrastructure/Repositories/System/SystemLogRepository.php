<?php

class SystemLogRepository extends Repository
{
    function __construct(SystemLog $model)
    {
        parent::__construct($model);
    }
}