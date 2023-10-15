<?php

final class View
{
    public static function get(string $filename, string $folder = null) :void
    {
        $source = getcwd() . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "UI" . DIRECTORY_SEPARATOR . "View" . DIRECTORY_SEPARATOR;
        
        if(!empty($folder)){
            $source .= $folder;
        }
        
        $view = $source . $filename;

        if(!file_exists($view)){
            throw new IOException("Unable to find the file for the specified view");
        }
    
        die(file_get_contents($view));
    }

}