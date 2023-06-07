<?php
include_once "../config/Database.php";
class User
{
    public $email;
    public $password;
    public $conn;
    public $uid;

    public function __construct($conn)
    {
        $this->conn = $conn->conn;
    }
    public function new_user($email, $password): bool
    {
        $this->email = pg_escape_string($this->conn, $email);
        $password = pg_escape_string($this->conn, $password);

        $query = "SELECT insert_user('$email'::varchar, '$password'::text)";
        $result = pg_query($this->conn, $query);
        if (pg_fetch_result($result, 0, 0) == "t") {
            return true;
        } else {
            return false;
        }
//    }
//    public function get_uid():void {
//        $query = "SELECT get_user_uid_by_email('$this->email')";
//        $result = pg_query($this->conn, $query);
//        $this->uid = pg_fetch_result($result, 0, 0);
//    }
//    public function login_user($email, $password)
//    {
//        $email = pg_escape_string($this->conn, $email);
//        $password = pg_escape_string($this->conn, $password);
//
//        $query = "SELECT get_password_hash('$email'::varchar)";
//        $result = pg_query($this->conn, $query);
//        $pass = pg_fetch_result($result, 0);
//        if ($pass == NULL) {
//            return false;
//        } else {
//            $this->get_uid();
//            return true;
//        }
    }
}
