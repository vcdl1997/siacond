<?php

class PersonService
{
    private $conn;
    private $userService;

    function __construct(
        PDO $conn
    )
    {
        $this->conn = $conn;
        $this->userService = new UserService($conn);
    }

    public function create(array $data = []) :PersonBaseDto
    {
        try{
            $typeOfPerson = Request::data_get($data, 'typeOfPerson', '');
            $personRepository = PersonRepositoryFactory::getRepository($typeOfPerson, $this->conn);
            $this->conn->beginTransaction();
            
            $user = $this->userService->create($data, $this->conn);
            $person = PersonFactory::createPerson($data)->userId($user->getId());
            $personRepository->defaultSqlCommand('INSERT', $person);
            
            $this->conn->commit();
            
            return $personRepository->getByUserId($user->getId());
        }catch(Throwable | Exception $e){
            $this->conn->rollBack();
            throw new BusinessException($e->getMessage());
        }
    }
}