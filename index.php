<?php

require_once 'conn.php';
require_once 'config.php';

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

    <div>
        <h2>Total Pengguna</h2>
        <p><?php echo getTotalPengguna(); ?></p>

        <h2>Total Vaksin</h2>
        <p><?php echo getTotalVaksin(); ?></p>

        <h2>Total Rumah Sakit</h2>
        <p><?php echo getTotalRumahSakit(); ?></p>

        <h2>Total Catatan Vaksin</h2>
        <p><?php echo getTotalCatatanVaksin(); ?></p>
    </div> 


    
</div>
    
</body>
</html>