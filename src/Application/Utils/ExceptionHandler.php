<?php

final class ExceptionHandler
{
    public static function resolve(Exception $exception) :void
    {
        switch(get_class($exception)){
            case "JSONException":
            case "InvalidParameterException":
                JSON::response($exception->getMessage(), HttpStatusCode::BAD_REQUEST);

            case "NotFoundException":
            case "IOException":
                JSON::response($exception->getMessage(), HttpStatusCode::NOT_FOUND);
               
            case "RuntimeException":
                JSON::response($exception->getMessage(), HttpStatusCode::INTERNAL_SERVER_ERROR);
        }

        
    }

}