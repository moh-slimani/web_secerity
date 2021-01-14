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

        $user = $this->single();

        if ($user) {
            $_SESSION["is_logged_in"] = true;
            $_SESSION["user_data"] = array(
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email
            );

            if ($data->remember_me) {
                $token = bin2hex(openssl_random_pseudo_bytes(16));

                $this->query("UPDATE users SET token = :token WHERE id = :id");
                $this->bind(':id', $user->id);
                $this->bind(':token', md5($token));

                $this->execute();

                setcookie('user_email', $user->email, time() + 60 * 60 * 24 * 30);
                setcookie('user_token', $token, time() + 60 * 60 * 24 * 30);
            }

            header("Location:" . URL);

            Messages::setMsg('Welcome ' . $user->name);
        } else {
            Messages::setMsg("Incorrect Login", "error");
        }
    }

    public function logout($id)
    {
        $this->query("UPDATE users SET token = :token WHERE email = :email");
        $this->bind(':email,', $id);
        $this->bind(':token,', null);

        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();

        setcookie('user_email', "");
        setcookie('user_token', "");
    }

    public function tokenLogin($data)
    {
        $token = md5($data->token);

        // Compare Login
        $this->query("SELECT * FROM users WHERE email = :email AND token = :token");
        $this->bind(":email", $data->email);
        $this->bind(":token", $token);

        $user = $this->single();

        if ($user) {
            $_SESSION["is_logged_in"] = true;
            $_SESSION["user_data"] = array(
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email
            );

            header("Location:" . URL);
        } else {
            setcookie('user_email', "");
            setcookie('user_token', "");
        }
    }

    public function sendPasswordRecoverToken($data)
    {
        $password_token = bin2hex(openssl_random_pseudo_bytes(32));

        $this->query("UPDATE users SET password_token = :password_token WHERE email = :email");
        $this->bind(':email', $data->email);
        $this->bind(':password_token', md5($password_token));

        $this->execute();

        require APP . 'libs/password_recover_email.php';

        $emailBody = PasswordRecoverEmail::generateEmail($data->email, $password_token);
        $altBody = 'please open this link to recover your email ' . 'http' . URL . 'users/recover_password?email=' . $data->email . '&token=' . $password_token;

        Helper::sendMail($data->email, $data->name, 'Password Recover', $emailBody, true, $altBody);
    }

    public function change_password($data)
    {
        $this->query('SELECT * from users WHERE password_token = :password_token AND email = :email');
        $this->bind(':email', $data->email);
        $this->bind(':password_token', md5($data->token));

        $user = $this->single();

        if ($user) {
            $this->query("UPDATE users SET password = :password, password_token = null WHERE password_token = :password_token AND email = :email");
            $this->bind(':password', md5($data->password));
            $this->bind(':email', $data->email);
            $this->bind(':password_token', md5($data->token));

            $this->execute();

            header("Location: " . URL . "users/login");
        } else {
            Messages::setMsg('Invalid Token', 'error');
        }

    }
}
