<?php

class UserTokenService
{
    private $userTokenRepository;

    function __construct(
        PDO $conn
    )
    {
        $this->userTokenRepository = new UserTokenRepository(null, $conn);
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

    public function tokenIsValid(string $token) :string
    {
        $token = str_replace("Bearer ", "", $token);

        if(!$this->userTokenRepository->tokenExists($token)){
            throw new JSONException(JSONError::getMessage('UNAUTHORIZED_ACCESS'));
        }

        $tokenDetails = JWT::decode($token);
        $expires = Request::data_get($tokenDetails, 'expires', 0);

        if(intval($expires) < time()){
            $this->deleteByToken($token);
            throw new JSONException(JSONError::getMessage('EXPIRED'));
        }

        return $token;
    }

    public function create(User $user) :array
    {
        $token = JWT::encode([ 
            'userId' => $user->getId(),
            'expires' => strtotime("now +" . Environment::getTokenExpirationTime() . "minutes")
        ]);

        $this->store([ 
            'userId' => $user->getId(), 
            'token' => $token,
        ]);

        return [
            "token" => $token
        ];
    }

    public function deleteByToken(string $token) :void
    {
        $this->userTokenRepository->deleteByToken($token);
    }
}