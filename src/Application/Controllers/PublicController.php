<?php

class PublicController extends Controller{

    private $userService;

    function __construct(
        mixed $data = null,
        UserService $userService = new UserService()
    ){
        parent::__construct($data);
        $this->userService = $userService;
    }

    public function index()
    {
        View::get("index");
    }

    public function authentication()
    {
        $output = $this->userService->authentication($this->data[self::RECEIVED]);
        JSON::response($output, HttpStatusCode::OK);
    }
}
