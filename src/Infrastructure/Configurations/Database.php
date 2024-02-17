<?php

final class Database{

    public static function getConnection() :PDO
    {
        $driver = getenv('DB_CONNECTION');
        $host = getenv('DB_HOST');
        $password = getenv('DB_PORT');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');

        if(!preg_match("/^(mysql|pgsql)$/",  $driver)){
            throw new Exception("Unsupported database driver");
        }

        try {
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            return new PDO("{$driver}:host={$host};port={$password};dbname={$dbname};charset=utf8", $user, $pass, $options);
        } catch(PDOException $e) {
            throw new Exception('ERROR: ' . $e->getMessage());
        }
    }

}