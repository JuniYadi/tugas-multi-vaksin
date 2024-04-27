<?php
// Mengambil data dari database untuk ditampilkan
require_once 'conn.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_vaksin = $_POST["kode_vaksin"];
    $nik = $_POST["nik"];
    $tanggal = $_POST["tanggal"];
    $dosis = $_POST["dosis"];
    $id_faskes = $_POST["id_faskes"];

    if (isset($_POST["edit"])) {
        ubahCatatanVaksin($_POST["id"], $nik, $kode_vaksin, $id_faskes, $tanggal, $dosis);
    } else {
        tambahCatatanVaksin($nik, $kode_vaksin, $id_faskes, $tanggal, $dosis);
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
        
        <h2>Daftar Catatan Vaksin</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Vaksin</th>
                <th>NIK</th>
                <th>Tanggal</th>
                <th>Dosis</th>
                <th>Rumah Sakit</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
                <th>Ubah</th>
                <th>Hapus</th>
            </tr>
            <?php
            $result = getCatatanVaksin();
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama_vaksin'] . "</td>";
                echo "<td>" . $row['nik'] . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "<td>" . $row['dosis'] . " mg </td>";
                echo "<td>" . $row['nama_faskes'] . "</td>";
                echo "<td>" . formatDate($row['created_at']) . "</td>";
                echo "<td>" . formatDate($row['updated_at']) . "</td>";
                echo "<td><a href='catatan-vaksin.php?edit=true&id=" . $row['id'] . "'>Edit</a></td>";
                echo "<td><a id='delete' href='delete.php?action=catatanvaksin&id=" . $row['id'] . "'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <?php
            if (isset($_GET["edit"])) {
                echo "<h2>Ubah Catatan Vaksin</h2>";
            } else {
                echo "<h2>Tambah Catatan Vaksin</h2>";
            }
        ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <?php
            $edit = false;

            $id = "";
            $kode_vaksin = "";
            $nik = "";
            $tanggal = "";
            $dosis = "";
            $id_faskes = "";

            if (isset($_GET['edit'])) {
                $edit = true;
                $id = $_GET['id'];
                $editData = getCatatanVaksinById($id);
                $kode_vaksin = $editData['kode_vaksin'];
                $nik = $editData['nik'];
                $tanggal = $editData['tanggal'];
                $dosis = $editData['dosis'];
                $id_faskes = $editData['id_faskes'];

                echo "<input type='hidden' name='edit' value='true'>";

                echo "<label for='id'>ID:</label><br>";
                echo "<input type='text' id='id' name='id' value='$id' readonly required><br><br>";
            }

            ?>

            <label for="kode_vaksin">Vaksin:</label><br>
            <select id="kode_vaksin" name="kode_vaksin" required>
                <option value="">Pilih Vaksin</option>

                <?php
                $vaksin = getVaksin();
                while ($row = mysqli_fetch_assoc($vaksin)) {
                    echo "<option value='" . $row['kode'] . "' " . ($row['kode'] == $kode_vaksin ? "selected" : "") . ">" . $row['nama'] . "</option>";
                }
                ?>
            </select><br><br>

            <label for="nik">NIK:</label><br>
            <select id="nik" name="nik" required>
                <option value="">Pilih Pengguna</option>

                <?php
                $pengguna = getPengguna();
                while ($row = mysqli_fetch_assoc($pengguna)) {
                    echo "<option value='" . $row['nik'] . "' " . ($row['nik'] == $nik ? "selected" : "") . ">" . $row['nik'] . " - " . $row['nama'] . "</option>";
                }
                ?>
            </select><br><br>
            
            <label for="tanggal">Tanggal:</label><br>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required><br><br>

            <label for="dosis">Dosis:</label><br>
            <input type="number" id="dosis" name="dosis" value="<?php echo $dosis; ?>" required><br><br>

            <label for="id_faskes">Rumah Sakit:</label><br>
            <select id="id_faskes" name="id_faskes" required>
                <option value="">Pilih Rumah Sakit</option>

                <?php
                $rumahSakit = getRumahSakit();
                while ($row = mysqli_fetch_assoc($rumahSakit)) {
                    echo "<option value='" . $row['id_faskes'] . "' " . ($row['id_faskes'] == $id_faskes ? "selected" : "") . ">" . $row['nama_faskes'] . "</option>";
                }
                ?>
            </select><br><br>

            <input type="submit" value="Submit">
            <button type="button" id="reset">Reset</button>
        </form>
    </div>

    <?php echo $js; ?>
</body>
</html>
