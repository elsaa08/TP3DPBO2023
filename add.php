<?php


include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Album.php');
include('classes/Produser.php');
include('classes/Template.php');
include('classes/Music.php');

//memanggil 
$view = new Template('template/add.html');
$prod = new Produser($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$prod->open();
$agensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$agensi->open();
$album = new Album($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$album->open();
$msc = new Music($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$msc->open();

//jika yg di klik merupakan ID (sudah ada dan akan update)
if (isset($_GET['id'])) {


    $id = $_GET['id'];
    if ($id > 0) {
        //buat field update biar pas update si field form nya itu udah diisi sama data yang mau di update
        $prod->getProdById($id);
        $data = $prod->getResult();
        $nama = $data['producer_nama'];
        $age = $data['producer_age'];
        $foto = $data['producer_foto'];
        $view->replace('DATA_NAMA', $nama);
        $view->replace('DATA_UMUR', $age);
        $view->replace('DATA_FOTO', $foto);
    }
    if (isset($_POST['btn-save'])) { //aksi button dengan nama 'btn-save'
        if ($prod->updateProd($id, $_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'detail.php';
            </script>";
        }
    }
} else {
    if (isset($_POST['btn-save'])) {
        if ($prod->addProd($_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'add.php';
            </script>";
        }
    }
    //inisialisasi form
    $data['producer_nama'] = "";
    $data['music_id'] = 0;
    $data['album_id'] = 0;
    $data['agencies'] = 0;
}


$agensi->getAgensi();
$msc->getMusic();
$album->getAlbum();

//buat field update biar pas update si field form OPTION nya itu udah diisi sama data yang mau di update
$options = null;
while ($row = $agensi->getResult()) {
    $options .= "<option value=" . $row['id_agensi'] . " " . (($row['id_agensi'] == $data['agencies']) ? "selected" : " ") . ">" . $row['agensi'] . "</option>";
}
$optionsmsc = null;
while ($row = $msc->getResult()) {
    $optionsmsc .= "<option value=" . $row['id_music'] . " " . (($row['id_music'] == $data['music_id']) ? "selected" : " ") . ">" . $row['musik'] . "</option>";
}
$optionsalbum = null;
while ($row = $album->getResult()) {

    $optionsalbum .= "<option value=" . $row['id_album'] . " " . (($row['id_album'] == $data['album_id']) ? "selected" : " ") . ">" . $row['album'] . "</option>";
}
//tutup
$prod->close();
$agensi->close();
$msc->close();

//isi data sesuai dengan option per tabel
$view->replace('DATA_AGENSI', $options);
$view->replace('DATA_MUSIC', $optionsmsc);
$view->replace('DATA_ALBUM', $optionsalbum);
$view->write();
