<?php
require "assets/header.php"; 
include '../connect.php';

$query = "SELECT * FROM berita ORDER BY tanggal_berita DESC";
$result = mysqli_query($conn, $query);

$daftarBeritaPenghuni = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $daftarBeritaPenghuni[] = [
            'id_berita' => $row['id_berita'],
            'judul' => $row['judul_berita'],
            'konten' => $row['isi_berita'],
            'tanggal' => $row['tanggal_berita']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asrama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    <?php include 'assets/style.css'; ?>
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Berita untuk Penghuni</h1>
        <ul class="list-group">
            <?php if (!empty($daftarBeritaPenghuni)) : ?>
                <?php foreach ($daftarBeritaPenghuni as $berita) : ?>
                    <li class="list-group-item">
                        <strong><?php echo $berita['judul']; ?></strong> <br>
                        <small><em><?php echo $berita['tanggal']; ?></em></small><br>
                        <p><?php echo nl2br($berita['konten']); ?></p>
                        <a href="komentar_penghuni.php?id=<?php echo $berita['id_berita']; ?>" class="btn btn-link">Beri Komentar</a>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <li class="list-group-item">Belum ada berita untuk penghuni.</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    include "assets/footer.php"
?>