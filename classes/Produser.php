<?php

class Produser extends DB
{
    function getProdJoin()
    {
        $query = "SELECT * FROM producer JOIN agencies ON producer.agencies=agencies.id_agensi JOIN music ON producer.music_id=music.id_music JOIN album ON producer.album_id=album.id_album ORDER BY producer.producer_id";

        return $this->execute($query);
    }

    function getProd()
    {
        $query = "SELECT * FROM producer";
        return $this->execute($query);
    }

    function getProdById($id)
    {
        $query = "SELECT * FROM producer JOIN agencies ON producer.agencies=agencies.id_agensi JOIN music ON producer.music_id=music.id_music JOIN album ON producer.album_id=album.id_album WHERE producer_id=$id";
        return $this->execute($query);
    }

    function searchProduser($keyword)
    {
        // ...
        $query = "SELECT * FROM producer JOIN agencies ON producer.agencies=agencies.id_agensi JOIN music ON producer.music_id=music.id_music JOIN album ON producer.album_id=album.id_album WHERE producer_nama LIKE '%$keyword%' OR agensi LIKE '%$keyword%' OR musik LIKE '%$keyword%' OR album LIKE '%$keyword%' ORDER BY producer.producer_id;";
        return $this->execute($query);
    }

    function addProd($data, $file)
    {
        // ...
        $foto = $file['foto']['name'];
        $producer_foto = $file['foto']['tmp_name'];

        $dir = 'assets/images/' . $foto;

        move_uploaded_file($producer_foto, $dir);
        $producer_nama = $data['nama'];
        $producer_age = $data['age'];
        $id_album = $data['album'];
        $id_agensi = $data['agensi'];
        $id_music = $data['music'];

        $query = "INSERT INTO producer VALUES('','$foto', '$producer_nama' , '$producer_age', '$id_music', '$id_album', '$id_agensi')";

        return $this->executeAffected($query);
    }

    function updateProd($id, $data, $file)
    {
        // ...
        $foto = $file['foto']['name'];
        $producer_foto = $file['foto']['tmp_name'];

        $dir = 'assets/images/' . $foto;

        move_uploaded_file($producer_foto, $dir);
        $producer_nama = $data['nama'];
        $producer_age = $data['age'];
        $id_album = $data['album'];
        $id_agensi = $data['agensi'];
        $id_music = $data['music'];

        $query = "UPDATE producer SET 
        producer_nama = '$producer_nama',
        producer_age = '$producer_age',
        producer_foto = '$foto',
        album_id = '$id_album',
        agencies = '$id_agensi',
        music_id = '$id_music'
        WHERE producer_id = $id";

        return $this->executeAffected($query);
    }

    function deleteProd($id)
    {
        // ...
        $query = "DELETE FROM producer WHERE producer_id = $id";
        return $this->executeAffected($query);
    }
}
