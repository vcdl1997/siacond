<?php

final class Environment
{
    const PRODUCTION = "production";
    const HOMOLOGATION = "homologation";
    const LOCAL = "local";

    public static function executionMode() :string
    {
    	return getenv('EXECUTION_MODE');
    }

    public static function getLanguage() :string
    {
    	return getenv('LANGUAGE');
    }

    public static function getTokenExpirationTime() :string
    {
    	return getenv('TOKEN_EXPIRATION_TIME');
    }
}