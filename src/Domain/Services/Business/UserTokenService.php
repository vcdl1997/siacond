<?php

class UserTokenService
{
    private $userTokenRepository;

    function __construct()
    {
        $this->userTokenRepository = new UserTokenRepository();
    }

    public function getUserByToken(string $token) :UserDto
    {
        return $this->userTokenRepository->getUserByToken($token);
    }

    public function store(array $data = []) :void
    {
        $userToken = UserToken::build()
            ->userId(Request::data_get($data, 'userId'))
            ->token(Request::data_get($data, 'token'))
        ;

        $this->userTokenRepository->defaultSqlCommand('INSERT', $userToken);
    }
}