<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
    include "../template/head.php";
?>
<?php
    include "../template/sidebar.php";
?>
<?php
    include "../template/top-bar.php";


if (isset($_POST['tambah_pasien'])) {
    $nama = $_POST['nama_pasien'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    
    $sql = "INSERT INTO pasien (nama_pasien, tanggal_lahir, alamat, no_telepon, jenis_kelamin) 
            VALUES ('$nama', '$tanggal_lahir', '$alamat', '$no_telepon', '$jenis_kelamin')";
    mysqli_query($koneksi, $sql);
    header("Location: pasien.php");
}
?>


<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Data Pasien</h1>
        <form method="POST">
            <div class="mb-3">
                <label>Nama Pasien</label>
                <input type="text" name="nama_pasien" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>No. Telepon</label>
                <input type="text" name="no_telepon" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <button type="submit" name="tambah_pasien" class="btn btn-primary">Tambah</button>
            <a href="pasien.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>
<?php
    include "../template/script.php"
?>
