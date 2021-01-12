<?php

class User extends Model
{
    /**
     * Register a new user
     *
     * @param $data
     */

    public function register($data)
    {

        $password = md5($data->password);

        if ($data->name == '' || $data->email == '' || $password == '') {
            Messages::setMsg('Please Fill In All Fields', 'error');
            return;
        }

        // Insert into MySQL
        $this->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");
        $this->bind(":name", $data->name);
        $this->bind(":email", $data->email);
        $this->bind(":password", $password);
        $this->execute();
        // Verify
        if ($this->lastInsertId()) {
            // Redirect
            header("Location: " . URL . "users/login");
        }

    }

    public function login($data)
    {

        $password = md5($data->password);

        // Compare Login
        $this->query("SELECT * FROM users WHERE email = :email AND password = :password");
        $this->bind(":email", $data->email);
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

            Messages::setMsg('Welcome ' . $row->name);
        } else {
            Messages::setMsg("Incorrect Login", "error");
        }

    }
}