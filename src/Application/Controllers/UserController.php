<?php

class UserController extends Controller{

    private $userService;

    function __construct(
        mixed $data = null,
        UserService $userService = new UserService()
    ){
        parent::__construct($data);
        $this->userService = $userService;
    }
}