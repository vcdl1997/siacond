<?php

final class View
{
    public static function get(string $filename) :void
    {
        $source = getcwd();
        
        $folders = [
            DIRECTORY_SEPARATOR . "src",
            DIRECTORY_SEPARATOR . "UI", 
            DIRECTORY_SEPARATOR . "dist",
            DIRECTORY_SEPARATOR . "ui"
        ];

        $target = $source . implode("", $folders);
        $destination = $source . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR;

        FolderHandler::clone($target, $destination);
        
        $view = $source . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . $filename;

        if(!file_exists($view)){
            throw new IOException("Unable to find the file for the specified view");
        }

        $content = file_get_contents($view);
        $dom = new DOMDocument; 
        $dom->loadHTML($content, LIBXML_NOERROR);

        foreach($dom->getElementsByTagName("script") as $script) {
            $target = $script->getAttribute('src');
            $substitute =  "." . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . $target;
            $content = str_replace($target, $substitute, $content);
        }

        foreach($dom->getElementsByTagName("link") as $script) {
            $target = $script->getAttribute('href');
            $substitute =  "." . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . $target;
            $content = str_replace($target, $substitute, $content);
        }

        die($content);
    }
}