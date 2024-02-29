<?php

class UserService
{
    private $userRepository;
    private $userTokenService;

    function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->userTokenService = new UserTokenService();
    }

    public function store(array $data = [], PDO $connAlternative = null) :User
    {
        $user = User::build()
            ->username(Request::data_get($data, 'username'))
            ->password(Request::data_get($data, 'password'))
        ;

        if($this->userRepository->existsUsersWithThisUsername($user->getUsername())){
            throw new BusinessException(UserRule::getMessage('USERNAME_IN_USE'));
        }

        $this->userRepository->defaultSqlCommand('INSERT', $user, $connAlternative);

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

        $user = $this->userRepository->getByUsernameAndTypeOfPerson($username, $typeOfPerson);

        if(empty($user)){
            throw new NotFoundException(UserRule::getMessage('NOT_FOUND'));
        }

        if (!$user->getActive()) {
            throw new BusinessException(UserRule::getMessage('INACTIVATED'));
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new BusinessException(UserRule::getMessage('INCORRECT_PASSWORD'));
        }

        $token = JWT::encode([ 
            'userId' => $user->getId() 
        ]);

        $this->userTokenService->store([ 'userId' => $user->getId(), 'token' => $token ]);

        return [
            "token" => $token
        ];
    }
}