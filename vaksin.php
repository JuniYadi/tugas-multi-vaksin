<?php
// Mengambil data dari database untuk ditampilkan
require_once 'conn.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_POST["kode"];
    $nama = $_POST["nama"];
    $dosis = $_POST["dosis"];
    
    if ($_POST["edit"] === "true") {
        ubahVaksin($kode, $nama, $dosis);
    } else {
        tambahVaksin($kode, $nama, $dosis);
    }

    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <?php echo $styles; ?>
</head>
<body>
    <?php echo $menu; ?>

    <div class="container">
        <h1><?php echo $title; ?></h1>
        
        <h2>Daftar Vaksin</h2>
        <table border="1">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Dosis</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
                <th>Ubah</th>
                <th>Hapus</th>
            </tr>
            <?php
            $result = getVaksin();
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['kode'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['dosis'] . " mg </td>";
                echo "<td>" . formatDate($row['created_at']) . "</td>";
                echo "<td>" . formatDate($row['updated_at']) . "</td>";
                echo "<td><a href='vaksin.php?edit=true&kode=" . $row['kode'] . "'>Edit</a></td>";
                echo "<td><a id='delete' href='delete.php?action=vaksin&kode=" . $row['kode'] . "'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <?php
            if (isset($_GET["edit"])) {
                echo "<h2>Ubah Vaksin</h2>";
            } else {
                echo "<h2>Tambah Vaksin</h2>";
            }
        ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <?php

            $kode = "";
            $nama = "";
            $dosis = "";
            $edit = false;

            if (isset($_GET['edit'])) {
                $edit = true;
                $kode = $_GET['kode'];
                $editData = getVaksinByKode($kode);
                $nama = $editData['nama'];
                $dosis = $editData['dosis'];

                echo "<input type='hidden' name='edit' value='true'>";
            }

            ?>

            <label for="kode">Kode:</label><br>
            <input type="text" id="kode" name="kode" value="<?php echo $kode; ?>" <?php echo $edit ? "readonly" : ""; ?> required><br><br>

            <label for="nama">Nama:</label><br>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required><br><br>

            <label for="dosis">Dosis:</label><br>
            <input type="number" id="dosis" name="dosis" value="<?php echo $dosis; ?>" required><br><br>

            <input type="submit" value="Submit">
            <button type="button" id="reset">Reset</button>
        </form>
    </div>

    <?php echo $js; ?>
</body>
</html>
