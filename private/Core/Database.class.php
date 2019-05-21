<?php

namespace Core;

use PDO;

class Database extends PDO
{
    static $instance;

    static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    function __construct()
    {
        $conn = 'mysql:host=' . Config::$DB['host'] . ';dbname=' . Config::$DB['name'] . ';charset=utf8';

        parent::__construct($conn, Config::$DB['user'], Config::$DB['password']);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function runQuery($query)
    {
        $sth = $this->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }
}