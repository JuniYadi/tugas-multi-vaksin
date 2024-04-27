<?php
// Mengambil data dari database untuk ditampilkan
require_once 'conn.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];

    if (isset($_POST["edit"]) && $_POST["edit"] === "true") {
        ubahRumahSakit($id, $nama, $alamat);
    } else {
        tambahRumahSakit($id, $nama, $alamat);
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
        
        <h2>Daftar Rumah Sakit</h2>
        <table border="1">
            <tr>
                <th>ID Faskes</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
                <th>Ubah</th>
                <th>Hapus</th>
            </tr>
            <?php
            $result = getRumahSakit();
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id_faskes'] . "</td>";
                echo "<td>" . $row['nama_faskes'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>" . formatDate($row['created_at']) . "</td>";
                echo "<td>" . formatDate($row['updated_at']) . "</td>";
                echo "<td><a href='rumah-sakit.php?edit=true&id=" . $row['id_faskes'] . "'>Edit</a></td>";
                echo "<td><a id='delete' href='delete.php?action=rumahsakit&id=" . $row['id_faskes'] . "'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <?php
            if (isset($_GET["edit"])) {
                echo "<h2>Ubah Rumah Sakit</h2>";
            } else {
                echo "<h2>Tambah Rumah Sakit</h2>";
            }
        ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <?php

            $id = "";
            $nama = "";
            $alamat = "";
            $edit = false;

            if (isset($_GET['edit'])) {
                $edit = true;
                $id = $_GET['id'];
                $editData = getRumahSakitByIdFaskes($id);
                $nama = $editData['nama_faskes'];
                $alamat = $editData['alamat'];

                echo "<input type='hidden' name='edit' value='true'>";
            }

            ?>

            <label for="id">ID Faskes:</label><br>
            <input type="text" id="id" name="id" value="<?php echo $id; ?>" <?php echo $edit ? "readonly" : ""; ?> required><br><br>

            <label for="nama">Nama:</label><br>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required><br><br>

            <label for="alamat">Alamat:</label><br>
            <input type="text" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required><br><br>

            <input type="submit" value="Submit">
            <button type="button" id="reset">Reset</button>
        </form>
    </div>

    <?php echo $js; ?>
</body>
</html>
