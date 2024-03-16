<?php

class SystemLogRepository extends Repository
{
    function __construct(
        SystemLog $model = null,
        PDO $conn
    )
    {
        parent::__construct(empty($model) ? new SystemLog() : $model, $conn);
    }
}