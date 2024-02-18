<?php

require_once "autoload.php";

$resource = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$personService = new PersonService();

try{
    Route::execute($resource);
}catch(Exception $e ){
    $systemLog = SystemLog::build($e)
        ->exception(get_class($e))
        ->message($e->getMessage())
        ->file($e->getFile())
        ->line($e->getLine())
        ->trace($e->getTraceAsString())
    ;
    $systemLogService = new SystemLogService($systemLog);
    $systemLogService->handleException($e);
}