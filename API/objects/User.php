<?php
include_once "../config/Database.php";
class User
{
    private $email;
    private $password;
    private $password_hash;
    public $conn;
    public $session_token;
    public $session_token_expiry_date;

    public function __construct($conn) {
        $this->conn = $conn->conn;
    }

    public function validate_session_token():bool {

    }

    public function set_user_email($email) {
        $this->email = $email;
    }
    public function set_user_password($password) {
        $this->password = $password;
    }
    public function set_session_token($token) {
        $this->session_token = $token;
    }
    public function new_user(): bool {
        $this->email = pg_escape_string($this->conn, $this->email);
        $this->password = pg_escape_string($this->conn, password_hash($this->password, PASSWORD_BCRYPT));

        $query = "SELECT new_user('$this->email'::varchar, '$this->password'::text)";
        $result = pg_query($this->conn, $query);
        if (pg_fetch_result($result, 0, 0) == "t") {
            return true;
        } else {
            return false;
        }
    }
    private function get_user_passhash() {
        $query = "SELECT password FROM public.users WHERE email = '$this->email'";
        $result = pg_query($this->conn, $query);
        $pgobject = pg_fetch_object($result);
        if (!$pgobject) { return false; }
        return $pgobject->password;
    }
    public function password_check(): bool {
        $server_pass = $this->get_user_passhash();
        if (!$server_pass) { return false; }
        if (password_verify($this->password, $server_pass)) {
            $this->password_hash = $server_pass;
            return true;
        } else {
            return false;
        }

    }
    public function login_user() {
        if ($this->password_check()) {
            $query = "SELECT user_login('$this->email'::varchar, '$this->password_hash'::text)";
            $result = pg_query($this->conn, $query);
            if (!$result) { return false; }

            $recordstring = pg_fetch_object($result)->user_login;
            $recordstring = trim($recordstring, '()');
            $values = explode(',', $recordstring);
            $values = array_map('trim', $values);
            $this->session_token = $values[0];
            $this->session_token_expiry_date = trim($values[1], '"');
            return true;
        } else {
            return false;
        }
    }

    public function logout_user(): bool {
        $query = "SELECT user_logout('$this->session_token'::uuid)";
        $result = pg_query($this->conn, $query);
        if (pg_fetch_object($result)->user_logout == "t") {
            return true;
        } else {
            return false;
        }
    }
}

