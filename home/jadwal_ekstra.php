<?php

$jadwalEkstrakurikuler = [
    ['kegiatan' => 'Basket', 'waktu' => 'Senin, 16:00'],
    ['kegiatan' => 'Paduan Suara', 'waktu' => 'Selasa, 17:00']
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kegiatan Ekstrakurikuler</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Jadwal Kegiatan Ekstrakurikuler</h1>
        <ul class="list-group">
            <?php foreach ($jadwalEkstrakurikuler as $jadwal) : ?>
                <li class="list-group-item">
                    <strong><?php echo $jadwal['kegiatan']; ?></strong>: <?php echo $jadwal['waktu']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
