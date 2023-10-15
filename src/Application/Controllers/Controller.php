<?php

abstract class Controller{

    protected $data;

    function __construct(array $data)
    {
        $this->data = $data;
    }
}