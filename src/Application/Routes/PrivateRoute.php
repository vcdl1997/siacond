<?php

class PrivateRoute implements IRoute
{
    public function getRoutes() :array
    {
        # Route => [ HTTP verb, Controller, Function, Requires Token, Permissions Required ]
        
        return [
            # Tokens
            '/api/tokens' => ['POST', TokenController::class, 'create', true, []],

            # Users
            '/api/users:getDataUserLogged' => ['GET', UserController::class, 'getDataUserLogged', true, []],

            # Persons
            '/api/persons' => ['POST', PersonController::class, 'create', true, []],

            # Condominiums
            '/api/condominiums' => ['GET', CondominiumController::class, 'listAll', true, []],
        ];
    }
}