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
        $this->host = getenv("DB_HOST");
        $this->db = getenv("POSTGRES_DB");
        $this->user = getenv("POSTGRES_USER");
        $this->password = getenv("POSTGRES_PASSWORD"); // change to your password

    }

    public function getConnection() {
        $this->conn = pg_connect("host=$this->host dbname=$this->db user=$this->user password=$this->password")
        or die (pg_last_error($this->conn));
    }

}


