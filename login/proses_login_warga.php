<?php
session_start();
require "../connect.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Gunakan password_hash untuk keamanan lebih baik

    // Cek di tabel admin
    $query_admin = "SELECT * FROM admin WHERE id_admin = '$username'";
    $result_admin = mysqli_query($conn, $query_admin);
    if (mysqli_num_rows($result_admin) > 0) {
        $row_admin = mysqli_fetch_assoc($result_admin);
        if ($row_admin['password_admin'] === $password) {
            // Login admin berhasil
            $_SESSION['nama_admin'] = $row_admin['nama_admin'];
            $_SESSION['role'] = 'admin';
            $_SESSION['logged_in'] = true;

            echo '<script>window.location.href= "../admin/main/dashboard.php";</script>';
            exit;
        } else {
            echo "<script>alert('Password salah untuk akun admin.'); window.location.href = 'login_warga.php';</script>";
            exit;
        }
    }

    // Cek di tabel pengurus
    $query_pengurus = "SELECT * FROM pengurus WHERE nim_pengurus = '$username'";
    $result_pengurus = mysqli_query($conn, $query_pengurus);
    if (mysqli_num_rows($result_pengurus) > 0) {
        $row_pengurus = mysqli_fetch_assoc($result_pengurus);
        if ($row_pengurus['password_pengurus'] === $password) {
            // Login pengurus berhasil
            $_SESSION['nim'] = $row_pengurus['nim_pengurus'];
            $_SESSION['nama'] = $row_pengurus['nama_pengurus'];
            $_SESSION['jurusan'] = $row_pengurus['jurusan_pengurus'];
            $_SESSION['alamat'] = $row_pengurus['alamat_pengurus'];
            $_SESSION['jenis_kelamin'] = $row_pengurus['jenis_kelamin_pengurus'];
            $_SESSION['no_kamar'] = $row_pengurus['no_kamar_pengurus'];
            $_SESSION['no_hp'] = $row_pengurus['nomor_handphone_pengurus'];
            $_SESSION['role'] = 'pengurus';
            $_SESSION['logged_in'] = true;

            echo '<script>window.location.href= "../home/index.php";</script>';
            exit;
        } else {
            echo "<script>alert('Password salah untuk akun pengurus.'); window.location.href = 'login_warga.php';</script>";
            exit;
        }
    }

    // Cek di tabel warga_asrama
    $query_warga = "SELECT * FROM warga_asrama WHERE nim_warga = '$username'";
    $result_warga = mysqli_query($conn, $query_warga);
    if (mysqli_num_rows($result_warga) > 0) {
        // Cek apakah warga sudah membayar
        $query_pembayaran = "SELECT nim_warga FROM pembayaran WHERE nim_warga = '$username' AND bukti_pembayaran IS NOT NULL AND TRIM(bukti_pembayaran) != ''";
        $result_pembayaran = mysqli_query($conn, $query_pembayaran);
        if (mysqli_num_rows($result_pembayaran) > 0) {
            $row_warga = mysqli_fetch_assoc($result_warga);
            if ($row_warga['password_warga'] === $password) {
                // Login warga berhasil
                $_SESSION['nim'] = $row_warga['nim_warga'];
                $_SESSION['nama'] = $row_warga['nama_warga'];
                $_SESSION['jurusan'] = $row_warga['jurusan_warga'];
                $_SESSION['alamat'] = $row_warga['alamat_warga'];
                $_SESSION['jenis_kelamin'] = $row_warga['jenis_kelamin_warga'];
                $_SESSION['no_kamar'] = $row_warga['no_kamar'];
                $_SESSION['no_hp'] = $row_warga['nomor_handphone_warga'];
                $_SESSION['role'] = 'warga';
                $_SESSION['logged_in'] = true;

                echo '<script>window.location.href= "../home/index.php";</script>';
                exit;
            } else {
                echo "<script>alert('Password salah untuk akun warga.'); window.location.href = 'login_warga.php';</script>";
                exit;
            }
        } else {
            // Jika warga belum membayar, arahkan ke halaman pembayaran
            echo "<script>
                alert('Anda belum menyelesaikan pembayaran,silahkan lakukan pembayaran.');
                window.location.href = 'pembayaran.php?username=$username';
                </script>";
            exit;
        }
    }

    // Jika username tidak ditemukan di semua tabel
    echo "<script>alert('Username atau password salah.'); window.location.href = 'login_warga.php';</script>";
    exit;
}
if (isset($_POST['register'])){
    header('location:register_warga.php');
}
?>
