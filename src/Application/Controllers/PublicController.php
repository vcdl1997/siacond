<?php

class PublicController extends Controller{

    function __construct($data = null){
        parent::__construct($data);
    }
    public function index()
    {
        View::get("main.html");
    }

    public function home()
    {
        $host = $this->data['host'];
        $token = array_key_exists("token", $this->data['data']) ? $this->data['data']['token'] : '';

        if(empty($token)){
            View::get("login.html");
        }

        if(false){
            View::get("home.html");
        }
        
        header("Refresh: 0; url={$host}");
    }

    public function login()
    {
        JSON::response($this->data, HttpStatusCode::OK);
    }

    public function logout()
    {
        JSON::response($this->data, HttpStatusCode::OK);
    }
}