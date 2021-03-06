<?php

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Users extends Controller
{
    /**
     * Songs constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user');
    }


    public function register()
    {
        $this->middleware('guest');

        if (isset($this->post->submit)) {
            $this->model->register($this->post);
        }

        require APP . 'view/_templates/auth_header.php';
        require APP . 'view/users/register.php';
        require APP . 'view/_templates/auth_footer.php';
    }

    public function login()
    {
        $this->middleware('guest');

        if (isset($this->post->submit)) {
            $this->model->login($this->post);
        }

        require APP . 'view/_templates/auth_header.php';
        require APP . 'view/users/login.php';
        require APP . 'view/_templates/auth_footer.php';
    }

    public function send_email()
    {
        $this->middleware('guest');

        if (isset($this->post->submit)) {
            $this->model->sendPasswordRecoverToken($this->post);
        }

        require APP . 'view/_templates/auth_header.php';
        require APP . 'view/users/send_email.php';
        require APP . 'view/_templates/auth_footer.php';
    }

    public function recover_password()
    {
        $this->middleware('guest');

        if (isset($this->post->submit)) {
            $this->model->change_password($this->post);
        }

        require APP . 'view/_templates/auth_header.php';
        require APP . 'view/users/recover_password.php';
        require APP . 'view/_templates/auth_footer.php';
    }

    public function logout()
    {
        $id = $_SESSION['user_data']['id'];
        $this->model->logout($id);
        // Redirect
        header('Location: ' . URL);
    }

}
