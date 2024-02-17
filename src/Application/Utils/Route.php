<?php

final class Route{

    const URL_POSSIBILITIES = [
        "http://localhost",
        "http://www.siacond.com.br",
        "https://www.siacond.com.br"
    ];
    const METHOD = 0;
    const CONTROLLER = 1;
    const FUNCTION = 2;

    
    private static function getRoutes() :array
    {
        $absolutePath = dirname(__FILE__);
        
        $arrAbsolutePath = explode(DIRECTORY_SEPARATOR, $absolutePath);
        
        $currentFolder = $arrAbsolutePath[count($arrAbsolutePath)-1];
        
        $routeFolder = str_replace($currentFolder, "routes", $absolutePath);
        
        $files = array_filter(array_map(function($name){
            if(!in_array($name, [".", "..", "IRoute.php", "Route.php"])) return str_replace(".php", "", $name);
        }, scandir($routeFolder)));

        $routes = [];

        foreach($files as $route){
            $route = new $route();
            $routes = array_merge($routes, $route->getRoutes());
        }

        return $routes;
    }


    public static function getCurrentRoute(string $method, string $resource, array $routes) :string
    {
        $resource = str_replace(self::URL_POSSIBILITIES, "", $resource);
        $resource = explode("?", $resource)[0];

        if(in_array($method, ['GET', 'PUT', 'PATCH', 'DELETE'])){
            $resource = implode('/', array_filter(explode("/", preg_replace('/[0-9]+/', '', $resource))));
        }

        foreach($routes as $route => $info)
        {
            $routeWithoutParams = "";

            if(in_array($info[self::METHOD], ['GET', 'PUT', 'PATCH', 'DELETE'])){
                $routeWithoutParams = implode("/", array_filter(array_map(function($value){
                    if(strpos($value, '{') === false && strpos($value, '}') === false) return $value;
                }, explode("/", $route))));
            }

            if($resource == $routeWithoutParams && $method == $info[self::METHOD]){
                return $route;
            }
        }

        throw new RuntimeException(RouteError::getMessage('NOT_FOUND'));        
    }

    public static function getData(string $resource, string $currentResource, string $method) :mixed
    {
        if(!in_array($method, ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])){
            throw new OutOfRangeException(RouteError::getMessage('INVALID_HTTP_VERB'));
        }

        $received = $query_params = [];

        switch($method){
            case "GET":
                self::extractPathParams($resource, $currentResource, $received);
                self::extractQueryParams($resource, $query_params);
                return array_merge($received, $query_params);

            case "POST":
                return JSON::decode(file_get_contents("php://input"));

            case "PUT":
            case "PATCH":
                self::extractPathParams($resource, $currentResource, $received);
                return array_merge($received, JSON::decode(file_get_contents("php://input")));

            case "DELETE":
                self::extractPathParams($resource, $currentResource, $received);
                return $received;
        }

        throw new RuntimeException(RouteError::getMessage('RECOVER_DATA'));
    }

    private static function extractQueryParams(string $resource, array &$data) :void
    {
        if(strpos($resource, "?") !== false){
            parse_str(explode("?", $resource)[1], $data);
        }
    }

    private static function extractPathParams(string $resource, string $currentResource, array &$data) :void
    {
        if(preg_match('/\/\d/', $resource)){
            $resource = str_replace(self::URL_POSSIBILITIES, "", $resource);
            
            $params = array_values(array_filter(array_map(function($value){
                $start = substr($value, 0, 1);
                $end = substr($value, -1);
                if($start == '{' && $end == '}') return str_replace(['{', '}'], "", $value);;
            }, explode("/", $currentResource))));

            $pathParams = array_values(array_filter(explode("/", $resource), 'is_numeric'));

            if(count($params) != count($pathParams)){
                throw new InvalidParameterException(RouteError::getMessage('NUMBER_OF_INVALID_PATH_PARAMETERS'));
            }

            foreach($pathParams as $index => $value){
                $name = $params[$index];
                $data[$name] = $value;
            }
        }
    }

    public static function getMethod() :string
    {
        return $_SERVER['REQUEST_METHOD'];
    } 

    public static function execute(string $resource) :mixed
    {
        $routes = self::getRoutes();
        $method = self::getMethod();
        $currentResource = self::getCurrentRoute($method, $resource, $routes);
        $received = [
            'host'  => (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]",
            'method' => $method,
            'currentRoute' => $currentResource, 
            'data' => self::getData($resource, $currentResource, $method)
        ];
       

        foreach($routes as $route => $info){
            if($currentResource == $route && $method == $info[self::METHOD]){
                $class      = $info[self::CONTROLLER];
                $function   = $info[self::FUNCTION];

                $controller = new $class($received);

                if(!method_exists($controller, $function)){
                    throw new RuntimeException(RouteError::getMessage('UNDECLARED_FUNCTION'));
                }

                return $controller->{$function}();
            }
        }

        throw new RuntimeException(RouteError::getMessage('INVALID_PROCESSING'));
    }
}