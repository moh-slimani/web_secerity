<?php

class Payment extends Model
{
    public $patientsModel = null;

    /**
     * Consultation constructor.
     */
    public function __construct()
    {
        require APP . 'model/patient.php';
        parent::__construct();
        $this->patientsModel = new Patient();
    }


    public function all()
    {

        $this->query("SELECT * FROM payments");
        $consultations = $this->resultSet();

        foreach ($consultations as $consultation) {
            $consultation->patient = $this->patientsModel->find($consultation->patient_id);
        }

        return $consultations;
    }

    public function find($id)
    {
        $this->query("SELECT * FROM payments WHERE id = :id");
        $this->bind(":id", $id);
        return $this->single();
    }

    public function save($data)
    {
        $sql = "INSERT INTO payments (date_received, total, amount, remainder, patient_id) 
VALUES (:date_received, :total, :amount, :remainder, :patient_id)";
        $this->query($sql);

        $this->bind(":date_received", $data->date_received);
        $this->bind(":total", $data->total);
        $this->bind(":amount", $data->amount);
        $this->bind(":remainder", $data->remainder);
        $this->bind(":patient_id", $data->patient_id);

        $this->execute();

        $id = $this->lastInsertId();

        if ($id) {
            header('Location: ' . URL . 'payments');
            return;
        }

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }
    }

    public function update($id, $data)
    {
        $sql = "UPDATE payments SET 
                    date_received = :date_received,
                    total = :total, 
                    amount = :amount, 
                    remainder = :remainder, 
                    patient_id = :patient_id WHERE id = :id";

        $this->query($sql);

        $this->bind(":id", $id);
        $this->bind(":date_received", $data->date_received);
        $this->bind(":total", $data->total);
        $this->bind(":amount", $data->amount);
        $this->bind(":remainder", $data->remainder);
        $this->bind(":patient_id", $data->patient_id);

        $this->execute();

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }

        header('Location: ' . URL . 'payments');
    }

    public function delete($id)
    {
        $this->query("DELETE  FROM payments WHERE id = :id");
        $this->bind(":id", $id);
        $this->execute();

    }

}
