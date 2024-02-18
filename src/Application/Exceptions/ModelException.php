<?php

class ModelException extends Exception{

    function __construct(string $message){
        parent::__construct($message);
    }

}