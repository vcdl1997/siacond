<?php

class CondominiumService
{
    private $condominiumRepository;

    function __construct()
    {
        $this->condominiumRepository = new CondominiumRepository();
    }

    public function listAll(array $data) :array
    {
        return $this->condominiumRepository->listAll($data);
    }
}