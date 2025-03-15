<?php
require "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pasien WHERE id_pasien='$id'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['update_pasien'])) {
    $id = $_POST['id_pasien'];
    $nama = $_POST['nama_pasien'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    
    $sql = "UPDATE pasien SET 
            nama_pasien='$nama', tanggal_lahir='$tanggal_lahir', alamat='$alamat', 
            no_telepon='$no_telepon', jenis_kelamin='$jenis_kelamin' 
            WHERE id_pasien='$id'";
    mysqli_query($koneksi, $sql);
    header("Location: pasien.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Data Pasien</h1>
        <form method="POST">
            <input type="hidden" name="id_pasien" value="<?= $row['id_pasien']; ?>">
            <div class="mb-3">
                <label>Nama Pasien</label>
                <input type="text" name="nama_pasien" class="form-control" value="<?= $row['nama_pasien']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?= $row['tanggal_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required><?= $row['alamat']; ?></textarea>
            </div>
            <div class="mb-3">
                <label>No. Telepon</label>
                <input type="text" name="no_telepon" class="form-control" value="<?= $row['no_telepon']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" <?= $row['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?= $row['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <button type="submit" name="update_pasien" class="btn btn-primary">Simpan</button>
            <a href="pasien.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>
