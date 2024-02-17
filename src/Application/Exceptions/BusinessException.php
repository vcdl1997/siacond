<?php

class BusinessException extends Exception{

    function __construct(string $message){
        parent::__construct($message);
    }

}