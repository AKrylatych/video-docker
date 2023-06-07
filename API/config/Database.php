<?php
$apiroot="http://api.video-docker.online/";
class Database
{
    private $host;
    private $db;
    private $user;
    private $password;
    public $conn;

    public function __construct() {
        $host = getenv("HOST");
        $db = getenv("DB");
        $user = getenv("POSTGRES_USER");
        $password = getenv("POSTGRES_PASSWORD"); // change to your password
    }

    public function test_con() {
        $host = getenv("HOST");
        $db = getenv("DB");
        $user = getenv("POSTGRES_USER");
        $password = getenv("POSTGRES_PASSWORD"); // change to your password

        $this->conn = pg_connect("host=$host dbname=$db user=$user password=$password")
        or die (pg_last_error($this->conn));

    }

    public function getConnection() {
        $this->conn = pg_connect("host=$this->host dbname=$this->db user=$this->user password=$this->password")
        or die (pg_last_error($this->conn));
    }

}


