<?php

spl_autoload_register(function($className){
    $envFilepath = "./.env";
    
    if (is_file($envFilepath)) {
        $file = new \SplFileObject($envFilepath);
        
        while (false === $file->eof()) {
            putenv(trim(str_replace('"', '', $file->fgets())));
        }
    }

    $dir = getcwd() . DIRECTORY_SEPARATOR . "src";
    $folders = [];
    getFolders($dir, $folders);

    foreach($folders as $folder){
        $file = $folder . $className . ".php";

        if(file_exists($file)){
            require_once $file;
        }
    }
});

function getFolders($dir, &$folders)
{
    if(strpos($dir, "UI") !== false) return false;
    
    $content = array_filter(array_map(function($name){
        if(!in_array($name, [".", ".."])) return $name;
    }, scandir($dir)));

    if(!empty($content)){
        foreach($content as $name){
            if(strpos($name, ".") === false){
                $name = $dir . DIRECTORY_SEPARATOR . $name;
                $start = strpos($name, "src");
                $end = strlen($name); 
                $folders[] = substr($name, $start, $end) . DIRECTORY_SEPARATOR;
                getFolders($name, $folders);
            }
        }
    }
}