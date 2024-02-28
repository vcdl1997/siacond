<?php

final class FileHandler
{
    public static function listAllFilesInDirectory(string $folder, array &$files) :void
    {
        $found = array_filter(array_map(function($name) use ($folder){
            if(!in_array($name, [".", ".."])){
                return $folder . DIRECTORY_SEPARATOR . $name;
            }
        }, scandir($folder)));

        foreach($found as $file){
            if (!preg_match('/\.{1}/', $file)){
                self::listAllFilesInDirectory($file, $files);
            }

            $files[] = $file;
        }
    }


    public static function clone(string $origin, string $destination) :void
    {
        $files = [];
        self::listAllFilesInDirectory($origin, $files);

        foreach($files as $file){
            $original = str_replace('\\\\', '\\', $file);
            $copy =  str_replace('\\\\', '\\', ($destination . DIRECTORY_SEPARATOR . str_replace($origin . DIRECTORY_SEPARATOR, "", $file)));

            if (!preg_match('/\.{1}/', $copy)){
                continue;
            }

            if (preg_match('/.css/', $copy) && strpos($copy, "assets") !== false){
                $content = self::replaceImagesInJsAndCss($original);
                file_put_contents($copy, $content);
            }else if (preg_match('/.js/', $copy) && strpos($copy, "assets") === false){
                $content = self::replaceImagesInJsAndCss($original);
                file_put_contents($copy, $content);
            }else {
                file_put_contents($copy, file_get_contents($original));
            }
        }
    }

    public static function replaceImagesInJsAndCss(string $nameFile) :string
    {
        $code = file_get_contents($nameFile);
        
        if(preg_match("/.css/", $nameFile)) self::replaceImagesInCss($code);
        if(preg_match("/.js/", $nameFile)) self::replaceImagesInJs($code);

        return $code;
    }

    public static function getContentFile(string $nameFile) :string
    {
        return htmlentities(file_get_contents($nameFile));
    }

    public static function replaceFilesInHtml(string $code) :string
    {
        self::replaceScripts($code);
        self::replaceStyles($code);

        return $code;
    }

    private static function replaceImagesInCss(string &$code) :void
    {
        foreach(explode("background-image:url", $code) as $image){
            if(preg_match("/assets/", $image) && preg_match("/images/", $image)){
                $image = substr($image, 1, strpos($image, ")")-1);
                $replace = implode("/", array_unique(explode("/", $image)));
                
                if(substr($replace, 0, 1) == "/") $replace = substr($replace, 1);
                if(strpos($replace, "./public/") === false) $replace = "./public/{$replace}";
                
                $code = str_replace($image, $replace, $code);
            }
        }
    }

    private static function replaceImagesInJs(string &$code) :void
    {
        $imagesToChange = [];

        foreach(explode('"src","', $code) as $script){
            if(preg_match("/assets/", $script) && preg_match("/images/", $script)){
                $script = substr($script, 0, strpos($script, '"'));
                $replace = substr($script, strpos($script, '/assets/'));
                $replace = str_replace('\\\\', '\\', implode("/", array_unique(explode("/", $replace))));

                if(!in_array($replace, $imagesToChange)){
                    $imagesToChange[] = $replace;
                }
            }
        }

        foreach($imagesToChange as $image){
            $code = str_replace($image, "./public/{$image}", $code);
        }
    }

    private static function replaceScripts(string &$html) :void
    {
        foreach(explode("src", $html) as $script){
            if(preg_match("/.js/", $script) && !preg_match("/public/", $script)){
                $script = str_replace("quot;", "", substr($script, 2, strpos($script, ".js")+1));
                $html = str_replace($script, "./public/{$script}", $html);
            }
        }
    }

    private static function replaceStyles(string &$html) :void
    {
        $stylesToChange = [];

        foreach(explode("href", $html) as $style){
            if(
                !(preg_match("/.css/", $style) && strpos($style, "app-root") !== false) &&
                !(preg_match("/.css/", $style) && !preg_match("/public/", $style))    
            ){
                continue;
            }

            $style = str_replace("quot;", "", substr($style, 2, strpos($style, ".css")+1));
            $style = strpos($style, "css") === false ? explode(".cs", $style)[0] . ".css" : $style;

            if(!in_array($style, $stylesToChange)){
                $stylesToChange[] = $style;
            }
        }

        foreach($stylesToChange as $style){
            $html = str_replace($style, "./public/{$style}", $html);
        }
    }
}