<?php

class PersonController extends Controller{

    private $personService;

    function __construct(
        mixed $data = null,
    ){
        parent::__construct($data);
        $this->personService = new PersonService($this->conn);
    }

    public function create()
    {
        $output = $this->personService->create($this->data[Controller::RECEIVED]);
        JSON::response($output->toArray(), HttpStatusCode::CREATED);
    }
}