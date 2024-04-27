<?php
$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "peli2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function formatDate($date) {
    return date("d/M/Y H:i:s", strtotime($date));
}

function getTotalPengguna() {
    global $conn;
    $query = "SELECT COUNT(*) AS total FROM Pengguna";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function getTotalVaksin() {
    global $conn;
    $query = "SELECT COUNT(*) AS total FROM Vaksin";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function getTotalRumahSakit() {
    global $conn;
    $query = "SELECT COUNT(*) AS total FROM RumahSakit";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function getTotalCatatanVaksin() {
    global $conn;
    $query = "SELECT COUNT(*) AS total FROM CatatanVaksin";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function getPengguna() {
    global $conn;
    $query = "SELECT * FROM Pengguna";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getPenggunaByNik($nik) {
    global $conn;
    $query = "SELECT * FROM Pengguna WHERE nik = '$nik'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function tambahPengguna($nik, $nama, $email, $hp) {
    global $conn;
    $query = "INSERT INTO Pengguna (nik, nama, email, hp) VALUES ('$nik', '$nama', '$email', '$hp')";
    mysqli_query($conn, $query);
}

function ubahPengguna($nik, $nama, $email, $hp) {
    global $conn;
    $query = "UPDATE Pengguna SET nama = '$nama', email = '$email', hp = '$hp' WHERE nik = '$nik'";
    mysqli_query($conn, $query);
}

function hapusPengguna($nik) {
    global $conn;
    $query = "DELETE FROM Pengguna WHERE nik = '$nik'";
    mysqli_query($conn, $query);
}

function getVaksin() {
    global $conn;
    $query = "SELECT * FROM Vaksin";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getVaksinByKode($kode) {
    global $conn;
    $query = "SELECT * FROM Vaksin WHERE kode = '$kode'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function tambahVaksin($kode, $nama, $dosis) {
    global $conn;
    $query = "INSERT INTO Vaksin (kode, nama, dosis) VALUES ('$kode', '$nama', '$dosis')";
    mysqli_query($conn, $query);
}

function ubahVaksin($kode, $nama, $dosis) {
    global $conn;
    $query = "UPDATE Vaksin SET nama = '$nama', dosis = '$dosis' WHERE kode = '$kode'";
    mysqli_query($conn, $query);
}

function hapusVaksin($kode) {
    global $conn;
    $query = "DELETE FROM Vaksin WHERE kode = '$kode'";
    mysqli_query($conn, $query);
}

function getRumahSakit() {
    global $conn;
    $query = "SELECT * FROM RumahSakit";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getRumahSakitByIdFaskes($id_faskes) {
    global $conn;
    $query = "SELECT * FROM RumahSakit WHERE id_faskes = '$id_faskes'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function tambahRumahSakit($id_faskes, $nama, $alamat) {
    global $conn;
    $query = "INSERT INTO RumahSakit (id_faskes, nama_faskes, alamat) VALUES ('$id_faskes', '$nama', '$alamat')";
    mysqli_query($conn, $query);
}

function ubahRumahSakit($id_faskes, $nama, $alamat) {
    global $conn;
    $query = "UPDATE RumahSakit SET nama_faskes = '$nama', alamat = '$alamat' WHERE id_faskes = '$id_faskes'";
    mysqli_query($conn, $query);
}

function hapusRumahSakit($id_faskes) {
    global $conn;
    $query = "DELETE FROM RumahSakit WHERE id_faskes = '$id_faskes'";
    mysqli_query($conn, $query);
}

function getCatatanVaksin() {
    global $conn;
    $query = <<<EOD
    SELECT 
        CatatanVaksin.id,
        CatatanVaksin.tanggal,
        CatatanVaksin.dosis,
        CatatanVaksin.created_at,
        CatatanVaksin.updated_at,
        Pengguna.nik,
        Pengguna.nama,
        Vaksin.kode AS kode_vaksin,
        Vaksin.nama AS nama_vaksin,
        RumahSakit.nama_faskes
    FROM 
        CatatanVaksin
    JOIN 
        Pengguna ON CatatanVaksin.nik = Pengguna.nik
    JOIN 
        Vaksin ON CatatanVaksin.kode_vaksin = Vaksin.kode
    JOIN 
        RumahSakit ON CatatanVaksin.id_faskes = RumahSakit.id_faskes;
EOD;

    $result = mysqli_query($conn, $query);
    return $result;
}

function tambahCatatanVaksin($nik, $kode_vaksin, $id_faskes, $tanggal, $dosis) {
    global $conn;
    $query = "INSERT INTO CatatanVaksin (nik, kode_vaksin, id_faskes, tanggal, dosis) VALUES ('$nik', '$kode_vaksin', '$id_faskes', '$tanggal', '$dosis')";
    mysqli_query($conn, $query);
}

function getCatatanVaksinById($id) {
    global $conn;
    $query = "SELECT * FROM CatatanVaksin WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function ubahCatatanVaksin($id, $nik, $kode_vaksin, $id_faskes, $tanggal, $dosis) {
    global $conn;
    $query = "UPDATE CatatanVaksin SET nik = '$nik', kode_vaksin = '$kode_vaksin', id_faskes = '$id_faskes', tanggal = '$tanggal', dosis = '$dosis' WHERE id = '$id'";
    mysqli_query($conn, $query);
}

function hapusCatatanVaksin($id) {
    global $conn;
    $query = "DELETE FROM CatatanVaksin WHERE id = '$id'";
    mysqli_query($conn, $query);
}

?>