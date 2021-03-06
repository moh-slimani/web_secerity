<?php

class Patients extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware();
        $this->loadModel('patient');
    }


    public function index()
    {
        $patients = $this->model->all();

        require APP . 'view/_templates/header.php';
        require APP . 'view/patients/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function create()
    {

        if (isset($this->post->submit)) {
            $this->model->save($this->post, $this->files);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/patients/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function edit($id)
    {
        $patient = $this->model->find($id);

        if (!$patient) {
            header('Location:' . URL . 'patients');
            Messages::setMsg('Not Found', 'error');
            return;
        }

        if (isset($this->post->submit)) {
            $this->model->update($id, $this->post, $this->files);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/patients/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function delete($id)
    {
        $patient = $this->model->find($id);

        if (!$patient) {
            Messages::setMsg('Not Found', 'error');
        } else {
            $this->model->delete($id);
        }

        header('Location:' . URL . 'patients');
        Messages::setMsg('Patient Deleted');

    }
}
