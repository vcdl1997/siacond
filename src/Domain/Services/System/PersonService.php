<?php

class PersonService
{
    private $personRepository;
    private $userService;

    function __construct(
        PersonRepository $personRepository = new PersonRepository(new Person()),
        UserService $userService = new UserService()
    )
    {
        $this->personRepository = $personRepository;
        $this->userService = $userService;
    }

    public function store(array $data = [], PDO $connAlternative = null) :PersonDto
    {
        $conn = empty($connAlternative) ? $this->personRepository->conn : $connAlternative;

        try{
            $conn->beginTransaction();
            $user = $this->userService->store($data, $conn);

            $person = Person::build()
                ->firstname(Request::data_get($data, 'firstname'))
                ->lastname(Request::data_get($data, 'lastname'))
                ->birthdate(Request::data_get($data, 'birthdate'))
                ->userId($user->getId())
            ;

            $this->personRepository->defaultSqlCommand('INSERT', $person, $conn);
            $dto = $this->personRepository->getByUserId($user->getId());
            $conn->commit();

            return $dto;

        }catch(Exception $e){
            $conn->rollBack();
            throw new BusinessException($e->getMessage());
        }
    }
}