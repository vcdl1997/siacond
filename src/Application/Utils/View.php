<?php

final class View
{
    public static function get(string $filename) :void
    {
        $source = getcwd();
        $folders = DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "UI" . DIRECTORY_SEPARATOR . "dist". DIRECTORY_SEPARATOR . "ui";
        $target = $source . $folders;
        $destination = $source . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR;

        FileHandler::clone($target, $destination);
        
        $view = $source . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . $filename . ".html";

        if(!file_exists($view)){
            throw new IOException(ViewError::getMessage('NOT_FOUND'));
        }

        $code = FileHandler::replaceFilesInHtml($view);

        die(html_entity_decode($code));
    }
}