<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Album.php');
include('classes/Produser.php');
include('classes/Template.php');
include('classes/Music.php');


$detail = new Template('template/skindetail.html');
$produser = new Produser($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$produser->open();

$data = nulL;

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($produser->deleteProd($id) > 0) {
            echo "
					<script>
						alert('Data berhasil dihapus!');
						document.location.href = 'index.php';
					</script>
				";
        } else {
            echo "
					<script>
						alert('Data gagal dihapus!');
						document.location.href = 'detail.php';
					</script>
				";
        }
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $produser->getProdById($id);
        $row = $produser->getResult();

        $data .= '<div class="card-header text-center" style="background-color: #e0aafa !important;">
        <h3 class="my-0">Detail ' . $row['producer_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['producer_foto'] . '" class="img-thumbnail" alt="' . $row['producer_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['producer_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>:</td>
                                    <td>' . $row['producer_age'] . '</td>
                                </tr>
                                <tr>
                                    <td>Judul Lagu</td>
                                    <td>:</td>
                                    <td>' . $row['musik'] . '</td>
                                </tr>
                                <tr>
                                    <td>Album</td>
                                    <td>:</td>
                                    <td>' . $row['album'] . '</td>
                                </tr>
                                <tr>
                                    <td>Agensi</td>
                                    <td>:</td>
                                    <td>' . $row['agensi'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end" style="background-color: #e0aafa !important;">
                <a href="add.php?id=' . $row['producer_id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="?hapus=' . $row['producer_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$produser->close();
$detail->replace('DATA_DETAIL_PRODUSER', $data);
$detail->write();
