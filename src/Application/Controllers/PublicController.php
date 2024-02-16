<?php

class PublicController extends Controller{

    function __construct($data = null){
        parent::__construct($data);
    }
    public function index()
    {
        View::get("index");
    }

    public function home()
    {
        JSON::response($this->data, HttpStatusCode::OK);
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