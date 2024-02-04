<?php

final class FolderHandler
{
    public static function clone(string $origin, string $destination) :void
    {
        $files = array_filter(array_map(function($name){
            if(!in_array($name, [".", ".."])) return $name;
        }, scandir($origin)));

        foreach($files as $file){
            $original = $origin . DIRECTORY_SEPARATOR . $file;
            $copy = $destination . DIRECTORY_SEPARATOR . $file;
            
            if (!copy($original, $copy)) {
                throw new IOException("Failed to copy {$file}");
            }
        }
    }
}