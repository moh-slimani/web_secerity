<?php

abstract class Controller
{
    /**
     * @var null Model
     */
    public $model = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
    }

    /**
     * Loads the "model".
     * @param $model
     */
    public function loadModel($model)
    {
        /** @noinspection PhpIncludeInspection */
        require APP . 'model/'. $model . '.php';
        $this->model = new $model();
    }
}
