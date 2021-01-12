<?php

class Analyses extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware();
        $this->loadModel('analysis');
    }


    public function index()
    {
        $analyses = $this->model->all();

        require APP . 'view/_templates/header.php';
        require APP . 'view/analyses/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function create()
    {

        if (isset($this->post->submit)) {
            $this->model->save($this->post);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/analyses/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function edit($id)
    {
        $analysis = $this->model->find($id);

        if (!$analysis) {
            header('Location:' . URL . 'analyses');
            Messages::setMsg('Not Found', 'error');
            return;
        }

        if (isset($this->post->submit)) {
            $this->model->update($id, $this->post);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/analyses/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function delete($id)
    {
        $analysis = $this->model->find($id);

        if (!$analysis) {
            Messages::setMsg('Not Found', 'error');
        } else {
            $this->model->delete($id);
        }

        header('Location:' . URL . 'analyses');
        Messages::setMsg('Consultation Deleted');

    }
}
