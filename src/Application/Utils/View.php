<?php

final class View
{
    public static function get(string $filename) :void
    {
        $runningInLocalhost = Environment::executionMode() === Environment::LOCAL;
        $source = getcwd();

        if($runningInLocalhost){
            $folders = DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "UI" . DIRECTORY_SEPARATOR . "dist". DIRECTORY_SEPARATOR . "ui";
            $target = $source . $folders;
            $destination = $source . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR;

            FileHandler::clear($destination);
            FileHandler::clone($target, $destination);
        }
        
        $view = $source . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . $filename . ".html";

        if(!file_exists($view)){
            throw new IOException(ViewError::getMessage('NOT_FOUND'));
        }

        $code = FileHandler::getContentFile($view);

        if($runningInLocalhost ){
            $code = FileHandler::replaceFilesInHtml($code);
            file_put_contents($view, html_entity_decode($code));
        }

        die(html_entity_decode($code));
    }
}