<?php

class SystemLogRepository extends Repository
{
    protected $model;

    function __construct(SystemLog $model)
    {
        parent::__construct($model);
    }

    public function getParamsFillable(Model $object) :array
    {
        $params = [];

        foreach($this->model->getFillable() as $param => $value){
            $params[":{$param}"] = $object->{$value}();
        }

        return $params;
    }
}