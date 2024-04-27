<?php
// Mengambil data dari database untuk ditampilkan
require_once 'conn.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $hp = $_POST["hp"];
    
    if ($_POST["edit"] === "true") {
        ubahPengguna($nik, $nama, $email, $hp);
    } else {
        tambahPengguna($nik, $nama, $email, $hp);
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
        
        <h2>Daftar Pengguna</h2>
        <table border="1">
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Email</th>
                <th>HP</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
                <th>Ubah</th>
                <th>Hapus</th>
            </tr>
            <?php
            $result = getPengguna();
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['nik'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['hp'] . "</td>";
                echo "<td>" . formatDate($row['created_at']) . "</td>";
                echo "<td>" . formatDate($row['updated_at']) . "</td>";
                echo "<td><a href='pengguna.php?edit=true&nik=" . $row['nik'] . "'>Edit</a></td>";
                echo "<td><a id='delete' href='delete.php?action=pengguna&nik=" . $row['nik'] . "'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <?php
            if (isset($_GET["edit"])) {
                echo "<h2>Edit Pengguna</h2>";
            } else {
                echo "<h2>Tambah Pengguna</h2>";
            }
        ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <?php

            $nik = "";
            $nama = "";
            $email = "";
            $hp = "";
            $edit = false;

            if (isset($_GET['edit'])) {
                $edit = true;
                $nik = $_GET['nik'];
                $editData = getPenggunaByNik($nik);
                $nama = $editData['nama'];
                $email = $editData['email'];
                $hp = $editData['hp'];

                echo "<input type='hidden' name='edit' value='true'>";
            }

            ?>

            <label for="nik">NIK:</label><br>
            <input type="number" id="nik" name="nik" value="<?php echo $nik; ?>" <?php if ($edit) echo "readonly"; ?>><br><br>
            
            <label for="nama">Nama:</label><br>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>"><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>

            <label for="hp">HP:</label><br>
            <input type="text" id="hp" name="hp" value="<?php echo $hp; ?>"><br><br>
            
            <input type="submit" value="Submit">
            <button type="button" id="reset">Reset</button>
        </form>
    </div>

    <?php echo $js; ?>
</body>
</html>
