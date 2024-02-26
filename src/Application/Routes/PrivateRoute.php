<?php

class PrivateRoute implements IRoute
{
    public function getRoutes() :array
    {
        // Route => [ HTTP verb, Controller, Function ]
        return [
            '/api/condominiums' => ['GET', CondominiumController::class, 'listAll']
        ];
    }
}