<?php

require_once "autoload.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');

$resource = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

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