<?php

class PublicController extends Controller{

    private $userService;

    function __construct(
        mixed $data = null,
        UserService $usuarioService = new UserService()
    ){
        parent::__construct($data);
        $this->userService = $usuarioService;
    }


    public function index()
    {
        View::get("index");
    }

    public function authentication()
    {
        $retorno = "";

        JSON::response($this->data, HttpStatusCode::OK);
    }
}