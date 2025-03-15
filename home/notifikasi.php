<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "asrama";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID fasilitas terakhir yang diubah
$last_updated_id = file_get_contents('../admin/main/last_updated.txt');

// Ambil data fasilitas berdasarkan ID terakhir yang diubah
$sql = "SELECT * FROM fasilitas WHERE id_fasilitas = '$last_updated_id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Notifikasi Pembaruan Fasilitas</title>
    <style>
        header h1 {
            font-size: 28px;
            margin: 0;
        }

        .content {
            padding: 20px;
        }

        .notification {
            background-color: #ffcc00;
            color: #333;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 18px;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #004080;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back:hover {
            background-color: #00264d;
        }
    </style>
</head>
<body>
    <?php require './assets/header.php';?>
    <header>
        <h1>Notifikasi Pembaruan Fasilitas</h1>
    </header>

    <div class="content">
        <?php
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='notification'>
                    <strong>Nama Fasilitas:</strong> {$row['nama_fasilitas']}<br>
                    <strong>Aturan Penggunaan Baru:</strong> {$row['aturan_penggunaan']}<br>
                  </div>";
        } else {
            echo "<p>Tidak ada pembaruan aturan penggunaan fasilitas.</p>";
        }
        ?>
        
        <a href="fasilitas.php" class="back" style="display: inline-block; padding: 10px 20px; background-color: #4a90e2; color: white; text-decoration: none; border-radius: 5px; font-size: 16px; transition: background-color 0.3s;">Kembali</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
<?php
    include "assets/footer.php";
?>