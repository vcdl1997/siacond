<?php

class CondominiumController extends Controller{

    private $condominiumService;

    function __construct(
        mixed $data = null,
        CondominiumService $condominiumService = new CondominiumService(),
    ){
        parent::__construct($data);
        $this->condominiumService = $condominiumService;
    }

    public function listAll()
    {
        $output = $this->condominiumService->listAll($this->data[Controller::RECEIVED]);
        JSON::response($output, HttpStatusCode::OK);
    }
}