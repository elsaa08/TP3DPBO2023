<?php

class Album extends DB
{
    function getAlbum()
    {
        $query = "SELECT * FROM album ORDER BY album ASC";
        return $this->execute($query);
    }

    function getAlbumById($id)
    {
        $query = "SELECT * FROM album WHERE id_album=$id";
        return $this->execute($query);
    }

    function addAlbum($data)
    {
        // ...
        $nama = $data['nama'];

        $query = "INSERT INTO album VALUES('','$nama')";

        return $this->executeAffected($query);
    }

    function updateAlbum($id, $data)
    {
        // ...
        $nama = $data['nama'];

        $query = "UPDATE album SET
            album = '$nama'
            WHERE id_album = $id";

        return $this->executeAffected($query);
    }

    function deleteAlbum($id)
    {
        // ...
        $query = "DELETE FROM album WHERE id_album=$id";
        return $this->executeAffected($query);
    }

    function sortAlbum($keyword)
    {
        $query = "SELECT * FROM album WHERE name LIKE '%$keyword%' ORDER BY name";
        return $this->execute($query);
    }
}
