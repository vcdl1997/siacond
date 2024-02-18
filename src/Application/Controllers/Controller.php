<?php

abstract class Controller{

    const HOST = "host";
    const METHOD = "method";
    const CURRENT_ROUTE = "currentRoute";
    const RECEIVED = "data";

    protected $data;

    function __construct(array $data)
    {
        $this->data = $data;
    }
}