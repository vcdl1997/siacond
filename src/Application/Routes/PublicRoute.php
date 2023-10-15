<?php

class PublicRoute implements IRoute
{
    public function getRoutes() :array
    {
        // Route => [ HTTP verb, Controller, Function ]
        return [
            '/' => ['GET', PublicController::class, 'index'],
            '/home' => ['GET', PublicController::class, 'home'],
            '/login' => ['POST', PublicController::class, 'login'],
            '/logout' => ['GET', PublicController::class, 'logout'],
        ];
    }
}