<?php

class PublicRoute implements IRoute
{
    public function getRoutes() :array
    {
        # Route => [ HTTP verb, Controller, Function, Requires Token, Permissions Required ]

        return [
            # Index
            '/' => ['GET', PublicController::class, 'index', false, []],

            # Login
            '/api/login' => ['POST', PublicController::class, 'authentication', false, []],
        ];
    }
}