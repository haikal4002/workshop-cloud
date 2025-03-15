<?php
include '../connect.php'; 
require 'assets/header.php'; 

// Query untuk mengambil data pembayaran yang sesuai
$pembayaran = "SELECT pembayaran.*, warga_asrama.nama_warga 
               FROM pembayaran 
               JOIN warga_asrama ON pembayaran.nim_warga = warga_asrama.nim_warga 
               WHERE pembayaran.metode_pembayaran = ?";
$stmt = $conn->prepare($pembayaran);
$stmt->bind_param('s', $_SESSION['nama']);
$stmt->execute();
$query_pembayaran = $stmt->get_result();
$result_pembayaran = $query_pembayaran->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pembayaran Kamar</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        td {
            text-align: left;
        }

        <?php include 'assets/style.css';
        ?>
        </style>
    </head>

    <body>
        <div class="container mt-5">
            <h1 class="text-center">Data Pembayaran</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Warga</th>
                        <th>NIM Warga</th>
                        <th>Metode Pembayaran</th>
                        <th>Nominal</th>
                        <th>Tanggal</th>
                        <th>Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($result_pembayaran)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($result_pembayaran as $data): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($data['nama_warga']); ?></td>
                        <td><?= htmlspecialchars($data['nim_warga']); ?></td>
                        <td><?= htmlspecialchars($data['metode_pembayaran']); ?></td>
                        <td><?= htmlspecialchars($data['nominal']); ?></td>
                        <td><?= htmlspecialchars($data['tanggal_pembayaran']); ?></td>
                        <td>
                            <?php if (!empty($data['bukti_pembayaran'])): ?>
                            <a href="../login/<?=($data['bukti_pembayaran']); ?>" target="_blank"
                                class="btn btn-primary">Lihat Bukti</a>
                                <a href="../login/<?=($data['bukti_pembayaran']); ?>" download class="btn btn-secondary">Download</a>    
                            <?php else: ?>
                            <span>Tidak Ada Bukti</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pembayaran.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </body>
    <?php include 'assets/footer.php'; ?>

</html>