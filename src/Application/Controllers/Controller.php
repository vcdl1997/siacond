<?php

abstract class Controller{

    const HOST = "host";
    const METHOD = "method";
    const CURRENT_ROUTE = "currentRoute";
    const RECEIVED = "data";
    const HEADERS = "headers";

    protected $data;
    protected $userTokenService;

    function __construct(
        array $data,
        UserTokenService $userTokenService = new UserTokenService()
    )
    {
        $this->data = $data;
        $this->userTokenService = $userTokenService;
        $this->embedLoggedInUserInData();
    }

    private function embedLoggedInUserInData() :void
    {
        $token = Request::data_get($this->data[self::HEADERS], "Authorization", "");
        
        if(!empty($token)){
            $data = JWT::decode(str_replace("Bearer ", "", $token));
            $this->data[self::RECEIVED]['userId'] = $data['userId'];
        }
    }
}