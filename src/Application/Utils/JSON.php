<?php

final class JSON
{
    public static function response(mixed $data, int $statusCode) :void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);
        die(json_encode($data ?? [], JSON_UNESCAPED_UNICODE));
    }

    public static function decode(mixed $data, bool $associative = true) :array
    {
        try{
            if(empty($data)){
                $data = "{}";
            }

            return json_decode($data, $associative);
        }catch(Exception $e){
            throw new JSONException(JSONError::getMessage('UNSUCCESSFUL_DECODING'));
        }
    }
}