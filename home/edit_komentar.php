<?php

include '../connect.php'; 
require 'assets/header.php'; 

$id_berita = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id_berita === 0) {
    die("ID berita tidak ditemukan.");
}
// Cek apakah pengguna sudah login
if (!isset($_SESSION['logged_in'])) {
    echo '<script>alert("Harap login terlebih dahulu!"); window.location.href = "login.php";</script>';
    exit;
}

// Cek apakah ID komentar diberikan
if (!isset($_GET['edit_komentar_id'])) {
    echo '<script>alert("ID komentar tidak ditemukan!"); window.location.href = "komentar_penghuni.php";</script>';
    exit;
}

$editId = (int)$_GET['edit_komentar_id'];
$nim_warga = $_SESSION['nim']; // NIM pengguna yang login
$role = $_SESSION['role']; // Peran pengguna (admin atau user)

// Ambil data komentar berdasarkan ID
$query = "SELECT * FROM komentar WHERE id_komentar = $editId";
$result = mysqli_query($conn, $query);

if ($result->num_rows === 0) {
    echo '<script>alert("Komentar tidak ditemukan!"); window.location.href = "komentar_penghuni.php";</script>';
    exit;
}

$komentar = $result->fetch_assoc();

// Periksa hak akses (hanya admin atau pemilik komentar yang bisa mengedit)
if ($role !== 'admin' && $nim_warga !== $komentar['nim_warga']) {
    echo '<script>alert("Anda tidak memiliki izin untuk mengedit komentar ini!"); window.location.href = "komentar_penghuni.php";</script>';
    exit;
}

// Proses update komentar
if (isset($_POST['update_komentar'])) {
    $updatedKomentar = $conn->real_escape_string($_POST['komentar']);

    $updateQuery = "UPDATE komentar SET isi_komentar = '$updatedKomentar' WHERE id_komentar = $editId";
    if (mysqli_query($conn, $updateQuery)) {
        echo '<script>window.location.href = "komentar_penghuni.php?id=' . $id_berita . '";</script>';
    } else {
        echo '<div class="alert alert-danger">Terjadi kesalahan: ' . mysqli_error($conn) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Komentar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    <?php include 'assets/style.css'; ?>
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Komentar</h1>

    <!-- Formulir untuk mengedit komentar -->
    <form method="POST">
        <div class="mb-3">
            <textarea name="komentar" class="form-control" required><?php echo htmlspecialchars($komentar['isi_komentar']); ?></textarea>
        </div>
        <button type="submit" name="update_komentar" class="btn btn-success">Perbarui Komentar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='komentar_penghuni.php?id=<?php echo $id_berita; ?>'">Kembali</button>
    </form>
</div>

<!-- Link ke Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    include "assets/footer.php"
?>