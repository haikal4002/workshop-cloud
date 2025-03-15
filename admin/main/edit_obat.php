<?php
require "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM obat WHERE id_obat='$id'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['update_obat'])) {
    $id = $_POST['id_obat'];
    $nama = $_POST['nama_obat'];
    $kategori = $_POST['kategori_obat'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    
    $sql = "UPDATE obat SET 
            nama_obat='$nama', kategori_obat='$kategori', harga='$harga', stok='$stok', deskripsi='$deskripsi' 
            WHERE id_obat='$id'";
    mysqli_query($koneksi, $sql);
    header("Location: obat.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Data Obat</h1>
        <form method="POST">
            <input type="hidden" name="id_obat" value="<?= $row['id_obat']; ?>">
            <div class="mb-3">
                <label>Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control" value="<?= $row['nama_obat']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <input type="text" name="kategori_obat" class="form-control" value="<?= $row['kategori_obat']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= $row['stok']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"><?= $row['deskripsi']; ?></textarea>
            </div>
            <button type="submit" name="update_obat" class="btn btn-primary">Simpan</button>
            <a href="obat.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>

