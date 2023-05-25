<?php

class Agensi extends DB
{
    function getAgensi()
    {
        $query = "SELECT * FROM agencies ORDER BY agensi";
        return $this->execute($query);
    }

    function getAgensiById($id)
    {
        $query = "SELECT * FROM agencies WHERE id_agensi=$id";
        return $this->execute($query);
    }

    function addAgensi($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO agencies VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateAgensi($id, $data)
    {
        // ...
        $nama = $data['nama'];
        $query = "UPDATE agencies SET
            agensi = '$nama'
            WHERE id_agensi = $id";

        return $this->executeAffected($query);
    }

    function deleteAgensi($id)
    {
        // ...
        $query = "DELETE FROM agencies WHERE id_agensi=$id";
        return $this->executeAffected($query);
    }
}
