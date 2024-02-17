<?php

final class JSON
{
    public static function response(mixed $data, int $statusCode) :void
    {
        http_response_code($statusCode);
        die(json_encode($data ?? []));
    }

    public static function decode(mixed $data, bool $associative = true) :array
    {
        try{
            return json_decode($data, $associative);
        }catch(Exception $e){
            throw new JSONException(JSONError::getMessage('UNSUCCESSFUL_DECODING'));
        }
    }
}