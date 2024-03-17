<?php

class TokenController extends Controller{

    private $userService;

    function __construct(
        mixed $data = null
    ){
        parent::__construct($data);
        $this->userService = new UserService($this->conn);
        $this->userTokenService = new UserTokenService($this->conn);
    }

    public function create()
    {
        $token = Request::data_get($this->data[self::HEADERS], "Authorization");

        $this->userTokenService->deleteByToken($token);

        JSON::response(
            $this->userTokenService->create($this->userService->getById($this->data[self::RECEIVED]['userId'])), 
            HttpStatusCode::CREATED
        );
    }
}