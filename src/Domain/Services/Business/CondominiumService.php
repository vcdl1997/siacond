<?php

class CondominiumService
{
    private $conn;
    private $condominiumRepository;

    function __construct(
        PDO $conn
    )
    {
        $this->conn = $conn;
        $this->condominiumRepository = new CondominiumRepository(null, $conn);
    }

    public function listAll(array $data) :array
    {
        return $this->condominiumRepository->listAll($data);
    }
}