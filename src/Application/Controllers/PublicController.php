<?php

class PublicController extends Controller{

    private $userService;

    function __construct(
        mixed $data = null
    ){
        parent::__construct($data);
        $this->userService = new UserService($this->conn);
    }

    public function index()
    {
        View::get("index");
    }

    public function authentication()
    {
        $retorno = $this->userService->authentication($this->data[self::RECEIVED]);
        JSON::response($retorno, HttpStatusCode::OK);
    }
}