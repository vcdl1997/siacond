<?php

class UserController extends Controller{

    private $userService;
    private $userPermission;
    private $userProfileService;

    function __construct(
        mixed $data = null
    ){
        parent::__construct($data);
        $this->userService = new UserService($this->conn);
        $this->userPermission = new UserPermissionService($this->conn);
        $this->userProfileService = new UserProfileService($this->conn);
    }

    public function getDataUserLogged()
    {
        JSON::response(
            [
                'profile' => $this->userProfileService->getProfileByUserId($this->data[Controller::RECEIVED]),
                'permissions' => $this->userPermission->listAllByUserIdAndCondominiumId($this->data[Controller::RECEIVED])
            ], 
            HttpStatusCode::OK
        );
    }
}