<?php

namespace App\Core;

use PDO;

class Database {

    private $host = "localhost";
    private $dbname = "user_management";
    private $username = "root";
    private $password = "";

    public function connect() {
        return new PDO(
            "mysql:host=$this->host;dbname=$this->dbname",
            $this->username,
            $this->password
        );
    }
}