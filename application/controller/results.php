<?php

class Results extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware();
        $this->loadModel('result');
    }


    public function index()
    {
        $results = $this->model->all();

        require APP . 'view/_templates/header.php';
        require APP . 'view/results/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function create()
    {
        $patients = $this->model->patientsModel->all();
        $analyses = $this->model->analysesModel->all();

        if (isset($this->post->submit)) {
            $this->model->save($this->post);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/results/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function edit($id)
    {
        $patients = $this->model->patientsModel->all();
        $result = $this->model->find($id);

        if (!$result) {
            header('Location:' . URL . 'results');
            Messages::setMsg('Not Found', 'error');
            return;
        }

        if (isset($this->post->submit)) {
            $this->model->update($id, $this->post);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/results/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function delete($id)
    {
        $results = $this->model->find($id);

        if (!$results) {
            Messages::setMsg('Not Found', 'error');
        } else {
            $this->model->delete($id);
        }

        header('Location:' . URL . 'results');
        Messages::setMsg('Consultation Deleted');

    }
}
