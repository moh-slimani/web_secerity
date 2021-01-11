<?php

class User extends Model
{
    /**
     * Register a new user
     *
     * @param bool $submit
     * @param string $name
     * @param string $email
     * @param string $password
     */

    public function register($submit = false, $name = "", $email = "", $password = "")
    {
        if ($submit) {

            $password = md5($password);

            if ($name == '' || $email == '' || $password == '') {
                Messages::setMsg('Please Fill In All Fields', 'error');
                return;
            }

            // Insert into MySQL
            $this->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");
            $this->bind(":name", $name);
            $this->bind(":email", $email);
            $this->bind(":password", $password);
            $this->execute();
            // Verify
            if ($this->lastInsertId()) {
                // Redirect
                header("Location: " . URL . "users/login");
            }
        }
    }

    public function login($submit = false, $email = "", $password = "")
    {
        if ($submit) {
            $password = md5($password);

            // Compare Login
            $this->query("SELECT * FROM users WHERE email = :email AND password = :password");
            $this->bind(":email", $email);
            $this->bind(":password", $password);

            $row = $this->single();

            if ($row) {
                $_SESSION["is_logged_in"] = true;
                $_SESSION["user_data"] = array(
                    "id" => $row->id,
                    "name" => $row->name,
                    "email" => $row->email
                );

                header("Location: " . URL);
            } else {
                Messages::setMsg("Incorrect Login", "error");
            }
        }
    }
}
