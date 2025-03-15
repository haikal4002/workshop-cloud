<?php
    ob_start(); // Mulai output buffering
    include "../template/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
?>
<?php
    include "../template/sidebar.php";
?>
<?php
    include "../template/top-bar.php";
?>
<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';

    // Pastikan sesi 'pendaftaran' diinisialisasi
    if (!isset($_SESSION['pendaftaran'])) {
        $_SESSION['pendaftaran'] = [];
    }

    // Jika admin menyetujui pendaftaran baru
    if (isset($_POST['setujui']) && isset($_POST['index']) && is_array($_POST['index'])) {
        foreach ($_POST['index'] as $index) {
            if (isset($_SESSION['pendaftaran'][$index])) {
                $input = $_SESSION['pendaftaran'][$index];

                // Pastikan $_POST['pengurus'][$index] dan $_POST['no_kamar'][$index] ada dan tidak null
                $pengurus = isset($_POST['pengurus'][$index]) ? $_POST['pengurus'][$index] : null;
                $no_kamar = isset($_POST['no_kamar'][$index]) ? $_POST['no_kamar'][$index] : null;

                if ($pengurus && $no_kamar) { // Cek jika pengurus dan no_kamar valid
                    $sql = "INSERT INTO warga_asrama (`nim_warga`, `nama_warga`, `jurusan_warga`, `alamat_warga`, `password_warga`, `jenis_kelamin_warga`, `nomor_handphone_warga`, `no_kamar`, `nim_pengurus`)
                            VALUES ('{$input['NIM']}', '{$input['nama']}', '{$input['jurusan']}', '{$input['alamat']}', '{$input['password']}', '{$input['kelamin']}', '{$input['hp']}', '$no_kamar', '$pengurus')";

                    $query = mysqli_query($conn, $sql);

                    if ($query) {
                        unset($_SESSION['pendaftaran'][$index]);
                        echo "<script>alert('Pendaftaran berhasil disetujui dan data dimasukkan ke database.')</script>";
                    } else {
                        echo "<script>alert('Terjadi kesalahan saat menyimpan data ke database.')</script>";
                    }
                } else {
                    echo "<script>alert('Pengurus atau nomor kamar tidak valid.')</script>";
                }
            }
        }
    }

    // Jika admin menghapus pendaftar
    if (isset($_POST['hapus']) && isset($_POST['index']) && is_array($_POST['index'])) {
        foreach ($_POST['index'] as $index) {
            unset($_SESSION['pendaftaran'][$index]); // Hapus data dari session
        }
        echo "<script>alert('Data berhasil dihapus dari daftar pendaftaran.')</script>";
    }

    // Jika admin menghapus yang dipilih
    if (isset($_POST['hapus_terpilih']) && isset($_POST['index']) && is_array($_POST['index'])) {
        foreach ($_POST['index'] as $index) {
            unset($_SESSION['pendaftaran'][$index]); // Hapus data yang dipilih
        }
        echo "<script>alert('Data yang dipilih berhasil dihapus.')</script>";
    }

    // Jika admin menghapus semua pendaftar
    if (isset($_POST['hapus_semua'])) {
        unset($_SESSION['pendaftaran']); // Hancurkan semua data dalam session
        echo "<script>alert('Semua data pendaftaran telah dihapus.')</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Warga</title>
</head>
<body>
    <form method="POST" action="pendaftaran.php">
        <table class="table table-striped table-bordered mt-4">
            <thead>
                <tr>
                    <th>Pendaftar</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Pengurus</th>
                    <th>No Kamar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($_SESSION['pendaftaran'])) {
                    foreach ($_SESSION['pendaftaran'] as $index => $data) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='index[]' value='{$index}'></td>";
                        echo "<td>{$data['NIM']}</td>";
                        echo "<td>{$data['nama']}</td>";
                        echo "<td>{$data['jurusan']}</td>";
                        echo "<td>{$data['alamat']}</td>";
                        echo "<td>
                                <select name='pengurus[{$index}]' class='form-select'>
                                    <option value=''>Pilih Pengurus</option>";
                                    $sql_pengurus = "SELECT nim_pengurus, nama_pengurus FROM pengurus";
                                    $result_pengurus = mysqli_query($conn, $sql_pengurus);
                                    while ($row = mysqli_fetch_assoc($result_pengurus)) {
                                        echo "<option value='{$row['nim_pengurus']}'>{$row['nama_pengurus']}</option>";
                                    }
                        echo "</select></td>";
                        echo "<td>
                                <select name='no_kamar[{$index}]' class='form-select'>
                                    <option value=''>Pilih No Kamar</option>";
                                    $sql_kamar = "SELECT no_kamar, status_kamar FROM kamar WHERE status_kamar = 'Tersedia'";
                                    $result_kamar = mysqli_query($conn, $sql_kamar);
                                    while ($row = mysqli_fetch_assoc($result_kamar)) {
                                        echo "<option value='{$row['no_kamar']}'>{$row['no_kamar']}</option>";
                                    }
                        echo "</select></td>";
                        echo "<td>
                                <button type='submit' name='setujui' class='btn btn-success'>Setujui</button>
                                <button type='submit' name='hapus' class='btn btn-danger'>Hapus</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Belum ada data pendaftaran.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-right mt-4">
            <button type="submit" name="hapus_semua" class="btn btn-danger">Hapus Semua</button>
            <button type="submit" name="hapus_terpilih" class="btn btn-danger">Hapus yang Dipilih</button>
        </div>
    </form>
</body>
</html>
<?php
ob_end_flush(); // Akhiri output buffering
?>
<?php
    include "../template/script.php"
?>

