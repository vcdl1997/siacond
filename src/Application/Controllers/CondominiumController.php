<?php

class CondominiumController extends Controller{

    private $condominiumService;

    function __construct(
        mixed $data = null,
    ){
        parent::__construct($data);
        $this->condominiumService = new CondominiumService($this->conn);
    }

    public function listAll()
    {
        $output = $this->condominiumService->listAll($this->data[Controller::RECEIVED]);
        JSON::response($output, HttpStatusCode::OK);
    }
}