<?php

class Payments extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware();
        $this->loadModel('payment');
    }


    public function index()
    {
        $payments = $this->model->all();

        require APP . 'view/_templates/header.php';
        require APP . 'view/payments/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function create()
    {
        $patients = $this->model->patientsModel->all();

        if (isset($this->post->submit)) {
            $this->model->save($this->post);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/payments/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function edit($id)
    {
        $patients = $this->model->patientsModel->all();
        $payment = $this->model->find($id);

        if (!$payment) {
            header('Location:' . URL . 'payments');
            Messages::setMsg('Not Found', 'error');
            return;
        }

        if (isset($this->post->submit)) {
            $this->model->update($id, $this->post);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/payments/edit.php';
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

        header('Location:' . URL . 'payments');
        Messages::setMsg('Consultation Deleted');

    }
}
