<?php

class UserService
{
    private $userRepository;
    private $userTokenService;

    function __construct(
        PDO $conn
    )
    {
        $this->userRepository = new UserRepository(null, $conn);
        $this->userTokenService = new UserTokenService($conn);
    }

    public function getById(int $userId) :User
    {
        return $this->userRepository->getById($userId);
    }

    public function create(array $data = []) :mixed
    {
        $user = User::build()
            ->username(Request::data_get($data, 'username'))
            ->password(Request::data_get($data, 'password'))
        ;

        if($this->userRepository->existsUsersWithThisUsername($user->getUsername())){
            throw new BusinessException(UserRule::getMessage('USERNAME_IN_USE'));
        }

        $this->userRepository->defaultSqlCommand('INSERT', $user);

        return $this->userRepository->getByUsername($user->getUsername());
    }

    public function authentication(array $data = []) :array
    {
        $username = Request::data_get($data, 'username', '');
        $password = Request::data_get($data, 'password', '');
        $typeOfPerson = Request::data_get($data, 'typeOfPerson', '');

        if(empty($username) || empty($username)){
            throw new BusinessException(UserRule::getMessage('NOT_PROVIDED'));
        }

        if(!in_array($typeOfPerson, [PersonBase::RESIDENT, PersonBase::EMPLOYEE])){
            throw new BusinessException(UserRule::getMessage('INVALID_PERSON_TYPE'));
        }

        $user = $this->userRepository->getByUsernameAndTypeOfPersonAndThatIsRelatedToCondominiums($username, $typeOfPerson);

        if(empty($user)){
            throw new NotFoundException(UserRule::getMessage('NOT_FOUND'));
        }

        if (!$user->getActive()) {
            throw new BusinessException(UserRule::getMessage('INACTIVATED'));
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new BusinessException(UserRule::getMessage('INCORRECT_PASSWORD'));
        }

        return $this->userTokenService->create($user);
    }
}