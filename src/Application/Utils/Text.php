<?php

final class Text
{
    public static function removeLineBreaks(string $text) :string
    {
       return str_replace(array("\r", "\n"), '', $text);
    }

    public static function checkIfEmailInString(string $text) :bool
    {
        $pattern = "/(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/";
        
        return preg_match($pattern, $text);
    }
}