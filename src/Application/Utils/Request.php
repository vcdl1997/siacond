<?php

final class Request
{
    public static function data_get(array $data, string $key, mixed $default = null) :mixed
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return $default;
    }
}