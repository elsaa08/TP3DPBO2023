<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Album.php');
include('classes/Template.php');


$view = new Template('template/skintabel.html');
$album = new Album($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$album->open();
$album->getAlbum();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($album->addAlbum($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'album.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'album.php';
            </script>";
        }
    }
    $button = 'Add';
    $title = 'Add';
}


$judul = 'Album';
$formLabel = 'album';


$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Album</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
while ($div = $album->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['album'] . '</td>
    <td style="font-size: 22px;">
        <a href="album.php?id=' . $div['id_album'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="album.php?hapus=' . $div['id_album'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($album->updateAlbum($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'album.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'album.php';
            </script>";
            }
        }

        $album->getAlbumById($id);
        $row = $album->getResult();
        $dataUpdate = $row['album'];
        $button = 'Update';
        $title = 'Update';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($album->deleteAlbum($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'album.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'album.php';
            </script>";
        }
    }
}

$album->close();
$view->replace('DATA_MAIN_TITLE', $judul);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $button);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
