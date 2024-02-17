<?php

final class Text
{
    public static function removeLineBreaks(string $text) :string
    {
       return str_replace(array("\r", "\n"), '', $text);
    }
}