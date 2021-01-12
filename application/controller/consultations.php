<?php

class Consultations extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware();
        $this->loadModel('consultation');
    }


    public function index()
    {
        $consultations = $this->model->all();

        require APP . 'view/_templates/header.php';
        require APP . 'view/consultation/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function create()
    {
        $patients = $this->model->patientsModel->all();

        if (isset($this->post->submit)) {
            $this->model->save($this->post);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/consultation/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function edit($id)
    {
        $patients = $this->model->patientsModel->all();
        $consultation = $this->model->find($id);

        if (!$consultation) {
            header('Location:' . URL . 'patients');
            Messages::setMsg('Not Found', 'error');
            return;
        }

        if (isset($this->post->submit)) {
            $this->model->update($id, $this->post);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/consultation/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function delete($id)
    {
        $consultation = $this->model->find($id);

        if (!$consultation) {
            Messages::setMsg('Not Found', 'error');
        } else {
            $this->model->delete($id);
        }

        header('Location:' . URL . 'patients');
        Messages::setMsg('Consultation Deleted');

    }
}
