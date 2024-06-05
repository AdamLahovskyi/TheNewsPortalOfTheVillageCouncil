<?php

namespace core;

class DB
{
    public $pdo;
    public function __constructor()
    {
        $host = Config::get()->dbHost;
        $name = Config::get()->dbName;
        $login = Config::get()->dbLogin;
        $password = Config::get()->dbPassword;
        $this->pdo = new \PDO("mysql:");
    }
}