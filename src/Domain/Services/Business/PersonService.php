<?php

class PersonService
{
    private $userService;

    function __construct(
        UserService $userService = new UserService()
    )
    {
        $this->userService = $userService;
    }

    public function store(array $data = [], PDO $connAlternative = null) :PersonBaseDto
    {
        $personRepository = PersonRepositoryFactory::getRepository(Request::data_get($data, 'typeOfPerson', ''));
        $conn = empty($connAlternative) ? $personRepository->conn : $connAlternative;

        try{
            $conn->beginTransaction();
            
            $user = $this->userService->store($data, $conn);
            $person = PersonFactory::createPerson($data)->userId($user->getId());
            $personRepository->defaultSqlCommand('INSERT', $person, $conn);
            $dto = $personRepository->getByUserId($user->getId());
            
            $conn->commit();
            
            return $dto;
        }catch(Exception $e){
            $conn->rollBack();
            throw new BusinessException($e->getMessage());
        }
    }
}