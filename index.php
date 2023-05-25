<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Album.php');
include('classes/Produser.php');
include('classes/Template.php');
include('classes/Music.php');


$listProd = new Produser($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listProd->open();
$listProd->getProdJoin();

if (isset($_POST['btn-cari'])) {

    $listProd->searchProduser($_POST['cari']);
} else {
    $listProd->getProdJoin();
}

$data = null;


while ($row = $listProd->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 produser-thumbnail">
        <a href="detail.php?id=' . $row['producer_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['producer_foto'] . '" class="card-img-top" alt="' . $row['producer_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text produser-nama my-0">' . $row['producer_nama'] . '</p>
                <p class="card-text musik-nama">' . $row['musik'] . '</p>
                <p class="card-text album-nama">' . $row['album'] . '</p>
                <p class="card-text agensi-nama my-0">' . $row['agensi'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listProd->close();

// buat instance template
$home = new Template('template/home.html');

// simpan data ke template
$home->replace('DATA_PRODUSER', $data);
$home->write();
