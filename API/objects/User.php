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

        $query = "SELECT new_user('$email'::varchar, '$password'::text)";
        $result = pg_query($this->conn, $query);
        if (pg_fetch_result($result, 0, 0) == "t") {
            return true;
        } else {
            return false;
        }
    }
    private function get_user_passhash($user_email) {
        $query = "SELECT password FROM public.users WHERE email = '$user_email'";
        try {
            $result = pg_query($this->conn, $query);
            $pgobject = pg_fetch_object($result);
            return $pgobject->password;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

    }
    public function password_check($user_email, $user_password) {

        $server_pass = $this->get_user_passhash($user_email);
        if (!$server_pass) { echo "Error occured, extiting."; exit(1);}
        var_dump($server_pass);
        echo "<br><br>";
        var_dump($user_password);
        if (password_verify($user_password, $server_pass)) {
            echo "Password correct! Cool!";
            return true;
        } else {
            echo "nope.";
            return false;
        }

    }
    public function login_user($email, $password) {
        if ($this->password_check($email, $password)) {
            echo "Authentification successful.";
        } else {
            echo "Auth bad.";
        }
//        $email = pg_escape_string($this->conn, $email);
//        $password = pg_escape_string($this->conn, $password);

//        $server_passhash = $this->get_user_passhash($email);
//        echo "<br>USER HASHED PASSWORD RETURNED: ", $server_passhash;
//        echo "file comparisons<br>server:";
//        var_dump($server_passhash);
//        echo "file comparisons<br>client:";
//        var_dump($password);
//        if (password_verify($password, $server_passhash, PASSWORD_BCRYPT)) {
//            echo "verified! hooray!";
//        } else {
//            echo "no go, password wrong.";
//        }


//        $query = "SELECT user_login('$email'::varchar, '$password')";
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
