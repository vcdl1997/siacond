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

        if(empty($username) || empty($username)){
            throw new BusinessException(UserRule::getMessage('NOT_PROVIDED'));
        }

        if(!$this->userRepository->existsUsersWithThisUsername($username)){
            throw new NotFoundException(UserRule::getMessage('NOT_FOUND'));
        }

        $user = $this->userRepository->getByUsername($username);

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