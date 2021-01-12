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
     * @var mixed
     */
    public $files = null;


    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (is_array($post)) {
            $this->post = new stdClass();
            foreach ($post as $key => $value) {
                $this->post->$key = $value;
            }
        }

        $files = $_FILES;

        if (is_array($files)) {
            $this->files = new stdClass();
            foreach ($files as $key => $value) {
                $this->files->$key = $value;
            }
        }
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
                if (!isset($_SESSION["is_logged_in"])) {
                    header("Location: " . URL . "users/login");
                }
                break;
            case "guest":
                if (isset($_SESSION["is_logged_in"])) {
                    header("Location: " . URL);
                }
                break;
        }
    }
}
