<?php

class Music extends DB
{
    function getMusic()
    {
        $query = "SELECT * FROM music ORDER BY musik";
        return $this->execute($query);
    }

    function getMusicById($id)
    {
        $query = "SELECT * FROM music WHERE id_music=$id";
        return $this->execute($query);
    }

    function addMusic($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO music VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateMusic($id, $data)
    {

        // ...
        $nama = $data['nama'];
        $query = "UPDATE music SET
            musik = '$nama'
            WHERE id_music = $id";
        return $this->executeAffected($query);
    }

    function deleteMusic($id)
    {
        // ...
        $query = "DELETE FROM music WHERE id_music=$id";
        return $this->executeAffected($query);
    }
}
