<?php

final class ExceptionHandler
{
    public static function resolve(Exception $exception) :void
    {
        switch(get_class($exception)){
            case "BusinessException":
                JSON::response($exception->getMessage(), HttpStatusCode::BAD_REQUEST);

            case "NotFoundException":
                JSON::response($exception->getMessage(), HttpStatusCode::NOT_FOUND);

            case "JSONException":
            case "InvalidParameterException": 
            case "IOException":
            case "OutOfRangeException":
            case "RuntimeException": 
                JSON::response($exception->getMessage(), HttpStatusCode::INTERNAL_SERVER_ERROR);
        }

        
    }

}