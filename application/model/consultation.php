<?php

class Consultation extends Model
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

        $this->query("SELECT * FROM consultations");
        $consultations = $this->resultSet();

        foreach ($consultations as $consultation) {
            $consultation->patient = $this->patientsModel->find($consultation->patient_id);
        }

        return $consultations;
    }

    public function find($id)
    {
        $this->query("SELECT * FROM consultations WHERE id = :id");
        $this->bind(":id", $id);
        return $this->single();
    }

    public function save($data)
    {
        $sql = "INSERT INTO consultations (type, date, appointment, price, description, patient_id) 
VALUES (:type, :date, :appointment, :price, :description, :patient_id)";
        $this->query($sql);

        $this->bind(":type", $data->type);
        $this->bind(":date", $data->date);
        $this->bind(":appointment", $data->appointment ? $data->appointment : null);
        $this->bind(":price", $data->price);
        $this->bind(":description", $data->description);
        $this->bind(":patient_id", $data->patient_id);

        $this->execute();

        $id = $this->lastInsertId();

        if ($id) {

            header('Location: ' . URL . 'consultations');
            return;
        }

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }
    }

    public function update($id, $data)
    {
        $sql = "UPDATE consultations SET 
                    type = :type,
                    date = :date, 
                    appointment = :appointment, 
                    price = :price, 
                    patient_id = :patient_id,
                    description = :description WHERE id = :id";

        $this->query($sql);

        $this->bind(":id", $id);
        $this->bind(":type", $data->type);
        $this->bind(":date", $data->date);
        $this->bind(":appointment", $data->appointment ? $data->appointment : null);
        $this->bind(":price", $data->price);
        $this->bind(":patient_id", $data->patient_id);
        $this->bind(":description", $data->description);

        $this->execute();

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }

    }

    public function delete($id)
    {
        $this->query("DELETE  FROM consultations WHERE id = :id");
        $this->bind(":id", $id);
        $this->execute();

    }

}
