<?php

class UserPermissionService
{
    private $userPermissionRepository;

    function __construct(
        PDO $conn
    )
    {
        $this->userPermissionRepository = new UserPermissionRepository(null, $conn);
    }

    public function listAllByUserIdAndCondominiumId(array $data) :array
    {
        $userId = Request::data_get($data, "userId");
        $condominiumId = Request::data_get($data, "condominiumId");

        return $this->userPermissionRepository->listAllByUserIdAndCondominiumId($userId, $condominiumId);
    }
}