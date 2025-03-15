<?php
session_start();
include '../connect.php';

// Jika admin menyetujui pendaftaran baru
if (isset($_POST['setujui'])) {
    // Memastikan nilai index terisi
    if (isset($_POST['index'])) {
        $index = $_POST['index'];  // Indeks data yang disetujui
        $input = $_SESSION['pendaftaran'][$index];

        // Mendapatkan nilai pengurus dan no kamar dari form
        $pengurus = $_POST['pengurus'];
        $no_kamar = $_POST['no_kamar'];
        // Memasukkan data ke database
        $sql = "INSERT INTO warga_asrama (`nim_warga`, `nama_warga`, `jurusan_warga`, `alamat_warga`, `password_warga`, `jenis_kelamin_warga`, `nomor_handphone_warga`, `no_kamar`, `nim_pengurus`)
                VALUES ('{$input['NIM']}', '{$input['nama']}', '{$input['jurusan']}', '{$input['alamat']}', '{$input['password']}', '{$input['kelamin']}', '{$input['hp']}', '$no_kamar', '$pengurus')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            // Hapus data yang sudah disetujui dari array
            unset($_SESSION['pendaftaran'][$index]);
            echo "<script>alert('Pendaftaran berhasil disetujui dan data dimasukkan ke database.')</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data ke database.')</script>";
        }
    } else {
        echo "<script>alert('Tidak ada data yang dipilih.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    </head>

    <body>
        <!-- Tabel untuk memilih pengurus dan nomor kamar -->
        <form method="POST" action="">
            <table class="table table-striped table-bordered mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th>Pendaftar</th>
                        <th>Nim</th>
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
    // Mengecek apakah data pendaftaran tersedia
    if (isset($_SESSION['pendaftaran']) && !empty($_SESSION['pendaftaran'])) {
        $pendaftaran = $_SESSION['pendaftaran'];
        foreach ($pendaftaran as $index => $data) {
            echo "<tr>";
            // Menambahkan input hidden untuk mengirim index pendaftar yang dipilih
            echo "<td><input type='radio' name='index' value='{$index}' required></td>";
            echo "<td>{$data['NIM']}</td>";
            echo "<td>{$data['nama']}</td>";
            echo "<td>{$data['jurusan']}</td>";
            echo "<td>{$data['alamat']}</td>";
            echo "<td>
                    <select name='pengurus' class='form-select'>
                        <option value=''>Pilih Pengurus</option>";
                        // Query untuk mendapatkan daftar pengurus
                        $sql_pengurus = "SELECT nim_pengurus, nama_pengurus FROM pengurus";
                        $result_pengurus = mysqli_query($conn, $sql_pengurus);
                        while ($row = mysqli_fetch_assoc($result_pengurus)) {
                            echo "<option value='{$row['nim_pengurus']}'>{$row['nama_pengurus']}</option>";
                        }
            echo "</select>
                </td>";
            echo "<td>
                    <select name='no_kamar' class='form-select'>
                        <option value=''>Pilih No Kamar</option>";
                        // Query untuk mendapatkan daftar kamar yang tersedia
                        $sql_kamar = "SELECT no_kamar, status_kamar FROM kamar WHERE status_kamar = 'Tersedia'";
                        $result_kamar = mysqli_query($conn, $sql_kamar);
                        while ($row = mysqli_fetch_assoc($result_kamar)) {
                            echo "<option value='{$row['no_kamar']}'>{$row['no_kamar']}</option>";
                        }
            echo "</select>
                </td>";
            echo "<td class='d-flex gap-2'>
                    <button type='submit' name='setujui' class='btn btn-success'>
                        Setujui
                    </button>
                    <button type='button' class='btn btn-danger' onclick='hapusData()'>
                        Hapus
                    </button>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>Belum ada data pendaftaran.</td></tr>";
    }
    ?>
                </tbody>

            </table>
        </form>

        <!-- Script untuk menangani tombol hapus -->
        <script>
        function hapusData() {
            if (confirm("Apakah Anda yakin ingin menghapus pendaftar ini?")) {
                // Anda dapat menambahkan logika untuk menghapus data sesuai kebutuhan
                alert("Data dihapus.");
            }
        }
        </script>
    </body>

</html>