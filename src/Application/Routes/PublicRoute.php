<?php

class PublicRoute implements IRoute
{
    public function getRoutes() :array
    {
        // Route => [ HTTP verb, Controller, Function ]
        return [
            '/' => ['GET', PublicController::class, 'index'],
            '/api/authentication' => ['POST', PublicController::class, 'login'],
        ];
    }
}