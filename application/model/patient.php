<?php

class Patient extends Model
{
    public function all()
    {

        $this->query("SELECT * FROM patients");
        return $this->resultSet();
    }

    public function find($id)
    {
        $this->query("SELECT * FROM patients WHERE id = :id");
        $this->bind(":id", $id);
        return $this->single();
    }

    public function save($data)
    {
        $sql = "INSERT INTO patients (civility, last_name, first_name, sex, address) 
VALUES (:civility, :last_name, :first_name, :sex, :address)";
        $this->query($sql);

        $this->bind(":civility", $data->civility);
        $this->bind(":last_name", $data->last_name);
        $this->bind(":first_name", $data->first_name);
        $this->bind(":sex", $data->sex);
        $this->bind(":address", $data->address);

        $this->execute();

        $id = $this->lastInsertId();

        if ($id) {
            header('Location: ' . URL . 'patients');
            Messages::setMsg('Patient Deleted' );
            return;
        }

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }
    }


    public function update($id, $data)
    {
        $sql = "UPDATE patients SET civility = :civility,
                    last_name = :last_name, 
                    first_name = :first_name, 
                    sex = :sex, 
                    address = :address WHERE id = :id";

        $this->query($sql);

        $this->bind(":id", $id);
        $this->bind(":civility", $data->civility);
        $this->bind(":last_name", $data->last_name);
        $this->bind(":first_name", $data->first_name);
        $this->bind(":sex", $data->sex);
        $this->bind(":address", $data->address);

        $this->execute();

        $sqlError = $this->errorInfo();

        if ($sqlError[0] = !'00000') {
            Messages::setMsg($sqlError[2]);
        }
    }

    public function delete($id) {
        $this->query("DELETE  FROM patients WHERE id = :id");
        $this->bind(":id", $id);
        $this->execute();

    }

}
