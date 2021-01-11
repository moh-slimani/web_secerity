<?php

abstract class Controller
{
    /**
     * @var null Model
     */
    public $model = null;
    /**
     * @var mixed
     */
    public $post = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        // Sanitize POST
        $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }

    /**
     * Loads the "model".
     * @param $model
     */
    public function loadModel($model)
    {
        /** @noinspection PhpIncludeInspection */
        require APP . 'model/' . $model . '.php';
        $this->model = new $model();
    }

    public function middleware($check = "auth")
    {
        switch ($check) {
            case "auth":
                if (!$_SESSION["is_logged_in"]) {
                    header("Location: " . URL . "users/login");
                }
                break;
            case "guest":
                if ($_SESSION["is_logged_in"]) {
                    header("Location: " . URL);
                }
                break;
        }
    }
}
