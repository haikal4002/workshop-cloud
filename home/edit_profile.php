<?php require 'assets/header.php'; ?>
<?php
include '../connect.php';
// include 'session_check.php';

// Ambil data pengguna dari sesi
$role = $_SESSION['role']; // Role pengguna
$success = null; // Variabel untuk cek apakah update berhasil

if ($role === 'pengurus') {
    // Query untuk tabel pengurus
    $id_pengurus = $_SESSION['nim']; // Ambil ID pengurus dari sesi
    $query = "SELECT * FROM pengurus WHERE nim_pengurus = '$id_pengurus'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    // Ambil data dari database
    $nama = $data['nama_pengurus'];
    $jurusan = $data['jurusan_pengurus'];
    $alamat = $data['alamat_pengurus'];
    $no_hp = $data['nomor_handphone_pengurus'];
} else {
    // Query untuk tabel warga asrama
    $nim = $_SESSION['nim']; // Ambil NIM dari sesi
    $query = "SELECT * FROM warga_asrama WHERE nim_warga = '$nim'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    // Ambil data dari database
    if ($_SESSION ['role']== 'warga'){
        $nama = $data['nama_warga'];
        $jurusan = $data['jurusan_warga'];
        $alamat = $data['alamat_warga'];
        $no_hp = $data['nomor_handphone_warga'];
    }else{
        $nama = $data['nama_pengurus'];
        $jurusan = $data['jurusan_pengurus'];
        $alamat = $data['alamat_pengurus'];
        $no_hp = $data['nomor_handphone_pengurus'];
    }
    }


// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_baru = $_POST['nama'];
    $jurusan_baru = $_POST['jurusan'];
    $alamat_baru = $_POST['alamat'];
    $no_hp_baru = $_POST['no_hp'];

    if ($role == 'pengurus') {
        // Update untuk tabel pengurus
        $query = "UPDATE pengurus SET 
                    nama_pengurus = '$nama_baru', 
                    jurusan_pengurus = '$jurusan_baru', 
                    alamat_pengurus = '$alamat_baru', 
                    nomor_handphone_pengurus = '$no_hp_baru' 
                  WHERE nim_pengurus = '$id_pengurus'";
    } else {
        // Update untuk tabel warga asrama
        $query = "UPDATE warga_asrama SET 
                    nama_warga = '$nama_baru', 
                    jurusan_warga = '$jurusan_baru', 
                    alamat_warga = '$alamat_baru', 
                    nomor_handphone_warga = '$no_hp_baru' 
                  WHERE nim_warga = '$nim'";
    }

    if (mysqli_query($conn, $query)) {
        // Update sesi dengan data baru
        $_SESSION['nama'] = $nama_baru;
        $_SESSION['jurusan'] = $jurusan_baru;
        $_SESSION['alamat'] = $alamat_baru;
        $_SESSION['no_hp'] = $no_hp_baru;

        $success = true; // Set sukses
    } else {
        $success = false; // Set gagal
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        <?php include 'assets/style.css'; ?>
    </style>
</head>

<body>

    <!-- Konten Edit Profil -->
    <main>
        <div class="profile-card">
            <div class="profile-header">
                <h2>Edit Profil</h2>
                <p><i class="fas fa-user-edit"></i> Ubah data profil Anda</p>
            </div>
            <div class="profile-body">
                <form action="edit_profile.php" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo $jurusan; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo $alamat; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $no_hp; ?>" required>
                    </div>
                    <button type="submit" class="btn">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Modal untuk Pesan Keberhasilan atau Kegagalan -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Status Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <?php if ($success !== null): ?>
                        <?php if ($success): ?>
                            <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
                            <p>Profil Anda berhasil diperbarui!</p>
                        <?php else: ?>
                            <i class="fas fa-times-circle fa-5x text-danger mb-3"></i>
                            <p>Terjadi kesalahan saat memperbarui profil. Silakan coba lagi.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="profil.php" class="btn btn-primary">Kembali ke Profil</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk menampilkan modal jika form berhasil disubmit -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if ($success !== null): ?>
            var myModal = new bootstrap.Modal(document.getElementById('statusModal'));
            myModal.show();
        <?php endif; ?>
    </script>
</body>

</html>
<?php
    include "assets/footer.php";
?>
