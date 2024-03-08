<?php

class PublicRoute implements IRoute
{
    public function getRoutes() :array
    {
        // Route => [ HTTP verb, Controller, Function, Permissions Required ]
        return [
            '/' => ['GET', PublicController::class, 'index', []],
            '/api/login' => ['POST', PublicController::class, 'authentication', []],
        ];
    }
}