<?php
require "../connect.php";
require "assets/header.php";

// Ambil ID berita dari URL
$id_berita = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id_berita === 0) {
    die("ID berita tidak ditemukan.");
}

// Ambil data dari sesi
$role = $_SESSION['role']; // Role pengguna (admin atau user)
$nama_warga = $_SESSION['nama']; // Nama pengguna yang login
$nim_warga = $_SESSION['nim']; // NIM pengguna yang login

// Penanganan penambahan komentar
if (isset($_POST['tambah_komentar'])) {
    $nim_warga = mysqli_real_escape_string($conn, $_SESSION['nim']);
    $nama_warga = mysqli_real_escape_string($conn, $_SESSION['nama']);
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);

    // Tambahkan komentar ke database dengan tanggal
    $query = "INSERT INTO komentar (nim_warga, nama_warga, isi_komentar, id_berita, tanggal) 
                VALUES ('$nim_warga', '$nama_warga', '$komentar', '$id_berita', NOW())";
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Komentar berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
    }
}

// Penanganan penghapusan komentar
if (isset($_GET['hapus_komentar_id'])) {
    $hapusId = (int)$_GET['hapus_komentar_id'];

    // Validasi apakah admin atau pemilik komentar
    $queryCheck = "SELECT * FROM komentar WHERE id_komentar = $hapusId AND (nim_warga = '$nim_warga' OR '$role' = 'admin')";
    $resultCheck = mysqli_query($conn, $queryCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        // Hapus komentar jika validasi lolos
        $queryDelete = "DELETE FROM komentar WHERE id_komentar = $hapusId";
        if (mysqli_query($conn, $queryDelete)) {
            echo "<div class='alert alert-success'>Komentar berhasil dihapus!</div>";
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Anda tidak memiliki izin untuk menghapus komentar ini.</div>";
    }
}

// Ambil data komentar dari database
$komentarPenghuni = [];
$query = "SELECT * FROM komentar WHERE id_berita = $id_berita ORDER BY id_komentar DESC";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $komentarPenghuni[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar Berita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    <?php include 'assets/style.css'; ?>
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Komentar</h1>
        <a href="berita_penghuni.php"><button class="btn btn-primary mb-4 bi bi-arrow-left-circle"> Kembali</button></a>
    
        <!-- Formulir untuk menambah komentar -->
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <input type="text" name="nim_warga" class="form-control" value="<?php echo $nama_warga; ?>" readonly>
            </div>
            <div class="mb-3">
                <textarea name="komentar" class="form-control" placeholder="Komentar" required></textarea>
            </div>
            <button type="submit" name="tambah_komentar" class="btn btn-primary">Tambah Komentar</button>
        </form>

        <h2>Daftar Komentar</h2>
        <ul class="list-group">
            <?php foreach ($komentarPenghuni as $komentar) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?php echo htmlspecialchars($komentar['nama_warga']); ?></strong> : 
                        <?php echo htmlspecialchars($komentar['isi_komentar']); ?>
                        <br>
                        <small class="text-muted"><?php echo $komentar['tanggal']; ?></small>
                    </div>
                    <div>
                        <?php if ($role === 'admin' || $nim_warga === $komentar['nim_warga']) : ?>
                            <a href="edit_komentar.php?id=<?php echo $id_berita; ?>&edit_komentar_id=<?php echo $komentar['id_komentar']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?id=<?php echo $id_berita; ?>&hapus_komentar_id=<?php echo $komentar['id_komentar']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    include "assets/footer.php";
?>