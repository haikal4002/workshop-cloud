<?php require './assets/header.php';?>
<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asrama";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data fasilitas dari database
$sql = "SELECT * FROM fasilitas";
$result = $conn->query($sql);

$fasilitas = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fasilitas[] = $row;
    }
} else {
    $fasilitas = [];
}

$conn->close();

// Pemetaan nama fasilitas ke emoticon
$fasilitas_emot = [
    "Kamar" => "🛏️",
    "Kantin" => "🍽️",
    "Ruang Belajar" => "📚",
    "Lapangan" => "🏀",
    "Perpustakaan" => "📖",
    "WiFi" => "📶",
    "Kolam Renang" => "🏊",
    "Parkir" => "🚗",
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas Asrama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* Emoticon diperbesar */
    .front span.emot {
        font-size: 72px;
        margin-bottom: 10px;
    }

    header h1 {
        font-size: 28px;
        margin: 0;
        color: #f9f9f9;
        padding-right: 40px;
    }

    .notification-icon {
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
        font-size: 24px;
        color: #f9f9f9;
        transition: color 0.3s ease;
    }

    .notification-icon:hover {
        color: #FFC107;
    }

    .underline {
        width: 100px;
        height: 4px;
        background-color: #FFC107;
        margin: 10px auto;
    }

    .grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
        justify-content: flex-start;
    }

    .grid-item {
        flex: 1 1 calc(25% - 20px); /* Membagi menjadi 4 kolom */
        max-width: calc(25% - 20px);
        height: 330px;
        perspective: 1000px;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 250px;
        height: 310px;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.5s;
    }

    .grid-item:hover .card {
        transform: rotateY(180deg);
    }

    .front, .back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
    }

    .front {
        background-color: #fff;
        border: 1px solid #ddd;
        flex-direction: column;
    }

    .back {
        background-color: #004080;
        color: white;
        transform: rotateY(180deg);
        font-size: 14px;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .name {
        margin-top: 10px;
        font-size: 16px;
        font-weight: bold;
        color: #004080;
    }

    .description {
        font-size: 14px;
        color: #666;
        margin-top: 5px;
        text-align: center;
        padding: 0 10px;
    }
    </style>
</head>
<body>

<header>
    <h1>Fasilitas Asrama</h1>
    <a href="notifikasi.php">
        <i class="fas fa-bell notification-icon"></i>
    </a>
</header>

<div class="underline"></div>

<div class="grid">
    <?php if (!empty($fasilitas)): ?>
        <?php foreach ($fasilitas as $fasilitas_item): ?>
            <?php 
            // Ambil emoticon berdasarkan nama fasilitas
            $emot = isset($fasilitas_emot[$fasilitas_item['nama_fasilitas']]) 
                    ? $fasilitas_emot[$fasilitas_item['nama_fasilitas']] 
                    : "🏢"; // Default emoticon
            ?>
            <div class="grid-item" onclick="window.location.href='detail.php?id=<?= htmlspecialchars($fasilitas_item['id_fasilitas'], ENT_QUOTES, 'UTF-8') ?>'">
                <div class="card">
                    <div class="front">
                        <span class="emot"><?= $emot ?></span>
                        <span><?= htmlspecialchars($fasilitas_item['nama_fasilitas'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="back">
                        <span>Lihat Detail</span>
                    </div>
                </div>
                <div class="name"><?= htmlspecialchars($fasilitas_item['nama_fasilitas'], ENT_QUOTES, 'UTF-8') ?></div>
                <p class="description"><?= htmlspecialchars($fasilitas_item['jumlah_fasilitas'], ENT_QUOTES, 'UTF-8') ?> unit tersedia.</p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; font-size: 18px; color: #666;">Tidak ada data fasilitas tersedia.</p>
    <?php endif; ?>
</div>

</body>
</html>
<?php include "assets/footer.php"; ?>
