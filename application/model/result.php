<?php

class Result extends Model
{
    public $patientsModel = null;
    public $analysesModel = null;

    /**
     * Consultation constructor.
     */
    public function __construct()
    {
        require_once APP . 'model/patient.php';
        require_once APP . 'model/analysis.php';

        parent::__construct();
        $this->patientsModel = new Patient();
        $this->analysesModel = new Analysis();
    }


    public function all()
    {

        $this->query("SELECT * FROM results");
        $results = $this->resultSet();

        foreach ($results as $result) {
            $result->patient = $this->patientsModel->find($result->patient_id);
            $result->analysis = $this->analysesModel->find($result->analysis_id);
        }

        return $results;
    }

    public function find($id)
    {
        $this->query("SELECT * FROM results WHERE id = :id");
        $this->bind(":id", $id);
        return $this->single();
    }

    public function save($data)
    {
        $sql = "INSERT INTO results (description, date, value, patient_id, analysis_id) 
            VALUES (:description,:date, :value, :patient_id, :analysis_id)";
        $this->query($sql);

        $this->bind(":description", $data->description);
        $this->bind(":date", $data->date);
        $this->bind(":value", $data->value);
        $this->bind(":analysis_id", $data->analysis_id);
        $this->bind(":patient_id", $data->patient_id);
        $this->execute();

        $id = $this->lastInsertId();

        if ($id) {
            header('Location: ' . URL . 'results');
            return;
        }

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }
    }

    public function update($id, $data)
    {
        $sql = "UPDATE results SET 
                    description = :description,
                    value = :value, 
                    analysis_id = :analysis_id,
                    patient_id = :patient_id WHERE id = :id";

        $this->query($sql);

        $this->bind(":id", $id);
        $this->bind(":description", $data->description);
        $this->bind(":value", $data->value);
        $this->bind(":analysis_id", $data->analysis_id);
        $this->bind(":patient_id", $data->patient_id);

        $this->execute();

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }

        header('Location: ' . URL . 'results');
    }

    public function delete($id)
    {
        $this->query("DELETE  FROM results WHERE id = :id");
        $this->bind(":id", $id);
        $this->execute();

    }

}
