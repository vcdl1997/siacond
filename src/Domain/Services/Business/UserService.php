<?php

class UserService
{
    private $userRepository;

    function __construct(User $user = new User())
    {
        $this->userRepository = new UserRepository($user);
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

    public function authentication(array $data = [], PDO $connAlternative = null) :User
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
}