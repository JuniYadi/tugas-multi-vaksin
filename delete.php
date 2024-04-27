<?php

require_once 'conn.php';

$action = $_GET['action'];
if ($action == 'pengguna') {
    $nik = $_GET['nik'];
    hapusPengguna($nik);
    header("Location: pengguna.php");
}

if ($action == 'vaksin') {
    $kode = $_GET['kode'];
    hapusVaksin($kode);
    header("Location: vaksin.php");
}

if ($action == 'rumahsakit') {
    $id = $_GET['id'];
    hapusRumahSakit($id);
    header("Location: rumah-sakit.php");
}

if ($action == 'catatanvaksin') {
    $id = $_GET['id'];
    hapusCatatanVaksin($id);
    header("Location: catatan-vaksin.php");
}


exit();
