<?php

$title  = "Multi Vaksin";

$styles = <<<EOD
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding-top: 50px;
    }

    .container {
        width: 100%;
        max-width: 1200px; /* or any other value */
        margin: 0 auto; /* centers the container */
        padding: 0 15px; /* optional: some padding on the sides */
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }

    .top-bar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #3498DB;
        overflow: auto;
        white-space: nowrap;
        padding: 10px 0;
    }
    .top-bar a {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    .top-bar a:hover {
        background-color: #3498DB;
        color: black;
    }
</style>

EOD;

$js = <<<EOD
<script>
    // listen to click button based on id
    document.addEventListener('click', function(e) {
        // if delete button is clicked
        if (e.target.id === 'delete') {
            if (!confirm('Lanjutkan menghapus data?')) {
                e.preventDefault();
            }
        }

        // if reset button is clicked
        if (e.target.id === 'reset') {
            // reload the page
            var current = window.location.href;
            // remove any query string
            var url = current.split('?')[0];
            // redirect to the same page
            window.location = url;
        }
    });

</script>
EOD;

$menu = <<<EOD
<div class="top-bar">
    <a href="/index.php">Home</a>
    <a href="/pengguna.php">Pengguna</a>
    <a href="/vaksin.php">Vaksin</a>
    <a href="/rumah-sakit.php">Rumah Sakit</a>
    <a href="/catatan-vaksin.php">Catatan Vaksin</a>
</div>
EOD;
?>