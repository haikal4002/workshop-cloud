<?php
require "koneksi.php";

if (isset($_POST['tambah_obat'])) {
    $nama = $_POST['nama_obat'];
    $kategori = $_POST['kategori_obat'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    
    $sql = "INSERT INTO obat (nama_obat, kategori_obat, harga, stok, deskripsi) 
            VALUES ('$nama', '$kategori', '$harga', '$stok', '$deskripsi')";
    mysqli_query($koneksi, $sql);
    header("Location: obat.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Data Obat</h1>
        <form method="POST">
            <div class="mb-3">
                <label>Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <input type="text" name="kategori_obat" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>
            <button type="submit" name="tambah_obat" class="btn btn-primary">Tambah</button>
            <a href="obat.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>
