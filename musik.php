<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Music.php');
include('classes/Template.php');

$musik = new Music($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$musik->open();
$musik->getMusic();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($musik->addMusic($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'musik.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'musik.php';
            </script>";
        }
    }
    $button = 'Add';
    $title = 'Add';
}

$view = new Template('template/skintabel.html');
$formLabel = 'music';
$judul = 'Musik';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Musik</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
while ($div = $musik->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['musik'] . '</td>
    <td style="font-size: 22px;">
        <a href="musik.php?id=' . $div['id_music'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="musik.php?hapus=' . $div['id_music'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($musik->updateMusic($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'musik.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'musik.php';
            </script>";
            }
        }

        $musik->getMusicById($id);
        $row = $musik->getResult();
        $dataUpdate = $row['musik'];

        $button = 'Update';
        $title = 'Update';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($musik->deleteMusic($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'musik.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'musik.php';
            </script>";
        }
    }
}

$musik->close();


$view->replace('DATA_MAIN_TITLE', $judul);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $button);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
