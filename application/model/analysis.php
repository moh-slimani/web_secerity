<?php

class Analysis extends Model
{
    public $patientsModel = null;

    /**
     * Consultation constructor.
     */
    public function __construct()
    {
        require_once APP . 'model/patient.php';
        parent::__construct();
    }


    public function all()
    {

        $this->query("SELECT * FROM analyses");
        return $this->resultSet();
    }

    public function find($id)
    {
        $this->query("SELECT * FROM analyses WHERE id = :id");
        $this->bind(":id", $id);
        return $this->single();
    }

    public function save($data)
    {
        $sql = "INSERT INTO analyses (designation, min_value, max_value, price) 
VALUES (:designation, :min_value, :max_value, :price)";
        $this->query($sql);

        $this->bind(":designation", $data->designation);
        $this->bind(":min_value", $data->min_value);
        $this->bind(":max_value", $data->max_value);
        $this->bind(":price", $data->price ? $data->price : null);

        $this->execute();

        $id = $this->lastInsertId();

        if ($id) {

            header('Location: ' . URL . 'analyses');
            return;
        }

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }
    }

    public function update($id, $data)
    {
        $sql = "UPDATE analyses SET 
                    designation = :designation,
                    min_value = :min_value, 
                    max_value = :max_value, 
                    price = :price WHERE id = :id";

        $this->query($sql);

        $this->bind(":id", $id);
        $this->bind(":designation", $data->designation);
        $this->bind(":min_value", $data->min_value);
        $this->bind(":max_value", $data->max_value);
        $this->bind(":price", $data->price ? $data->price : null);

        $this->execute();

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }

        header('Location: ' . URL . 'analyses');

    }

    public function delete($id)
    {
        $this->query("DELETE  FROM analyses WHERE id = :id");
        $this->bind(":id", $id);
        $this->execute();

    }

}
