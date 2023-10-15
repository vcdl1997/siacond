<?php

require_once "autoload.php";

$resource = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

try{
    Route::execute($resource);
}catch(Exception $e){
    ExceptionHandler::resolve($e);
}