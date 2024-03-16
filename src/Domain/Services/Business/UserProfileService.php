<?php

class UserProfileService
{
    private $userProfileRepository;

    function __construct(
        PDO $conn
    )
    {
        $this->userProfileRepository = new UserProfileRepository(null, $conn);
    }

    public function getProfileByUserId(array $data) :string
    {
        $userId = Request::data_get($data, "userId");

        return $this->userProfileRepository->getProfileByUserId($userId);
    }
}