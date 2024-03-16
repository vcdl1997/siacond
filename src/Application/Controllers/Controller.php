<?php

abstract class Controller{

    const HOST = "host";
    const METHOD = "method";
    const CURRENT_ROUTE = "currentRoute";
    const RECEIVED = "data";
    const HEADERS = "headers";
    const REQUIRES_TOKEN = "requiresToken";
    const PERMISSIONS_REQUIRED = "permissionsRequired";

    protected $conn;
    protected $data;
    protected $userTokenService;
    

    function __construct(
        array $data
    )
    {
        $this->conn = Database::getConnection();
        $this->data = $data;
        $this->userTokenService = new UserTokenService($this->conn);
        $this->checkRoute();
    }

    private function checkRoute() :void
    {
        $token = Request::data_get($this->data[self::HEADERS], "Authorization", "");
        $tokenNotIsPresent = empty($token);
        $routeRequiresToken = $this->data[self::REQUIRES_TOKEN];

        if(!$routeRequiresToken){
            return;
        } 

        if($tokenNotIsPresent){
            throw new JSONException(JSONError::getMessage('UNAUTHORIZED_ACCESS'));
        }

        $this->validate($token);
    }

    private function validate(string $token) :void
    {
        $this->embeddingData($this->userTokenService->tokenIsValid($token));
    }

    private function embeddingData(string $token) :void
    {
        $tokenDetails = JWT::decode($token);
        
        $this->data[self::HEADERS]["Authorization"] = $token;
        $this->data[self::RECEIVED]['userId'] = Request::data_get($tokenDetails, "userId", "");
        $this->data[self::RECEIVED]['permissions'] = [];
    }
}