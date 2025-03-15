<?php
require "koneksi.php";

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM pasien WHERE id_pasien='$id'";
    mysqli_query($koneksi, $sql);
    header("Location: pasien.php");
}

$sql = "SELECT * FROM pasien";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Ruang Kesehatan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index_pasien.php">Data Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index_obat.php">Data Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pasien.php">Tambah Data Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="obat.php">Tambah Data Obat</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Data Pasien</h1>
        <a href="tambah_pasien.php" class="btn btn-primary mb-3">Tambah Pasien</a>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . $row['id_pasien'] . "</td>
                            <td>" . $row['nama_pasien'] . "</td>
                            <td>" . date("d-m-Y", strtotime($row['tanggal_lahir'])) . "</td>
                            <td>" . $row['alamat'] . "</td>
                            <td>" . $row['no_telepon'] . "</td>
                            <td>" . ($row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') . "</td>
                            <td>
                                <a href='edit_pasien.php?id=" . $row['id_pasien'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='?hapus=" . $row['id_pasien'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
