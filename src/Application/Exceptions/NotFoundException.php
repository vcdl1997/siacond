<?php

class NotFoundException extends Exception{

    function __construct(string $message){
        parent::__construct($message);
    }

}