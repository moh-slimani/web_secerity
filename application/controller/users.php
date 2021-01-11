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
        if (isset($this->post['submit'])) {
            call_user_func_array(array($this->model, 'register'), $this->post);
        }

        require APP . 'view/_templates/auth_header.php';
        require APP . 'view/users/register.php';
        require APP . 'view/_templates/auth_footer.php';
    }

    public function login()
    {
        $this->middleware('guest');
        if (isset($this->post['submit'])) {
            call_user_func_array(array($this->model, 'login'), $this->post);
        }

        require APP . 'view/_templates/auth_header.php';
        require APP . 'view/users/login.php';
        require APP . 'view/_templates/auth_footer.php';
    }

    public function logout()
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        // Redirect
        header('Location: ' . URL);
    }

}
