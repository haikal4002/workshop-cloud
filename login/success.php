<?php
    include "../connect.php"
?>
<?php
session_start();

// Pastikan session pembayaran berhasil
// if (!isset($_SESSION['pembayaran_sukses']) || !$_SESSION['pembayaran_sukses']) {
//     // Jika session tidak ada atau pembayaran gagal, arahkan kembali
//     header('Location: pembayaran.php');
//     exit();
// }

// Ambil data dari session atau dari database
$nim = $_SESSION['pendaftaran']['NIM'] ?? 'NIM tidak ditemukan';
$q_nama = "SELECT nama_warga FROM warga_asrama WHERE nim_warga='$nim'";
$result= mysqli_query($conn,$q_nama);
if ($result && mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama_warga'];
}
$nominal = $_SESSION['pembayaran']['nominal'] ?? 'Nominal tidak ditemukan';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sukses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 40px;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4CAF50;
            text-align: center;
        }
        .info {
            margin-bottom: 20px;
            font-size: 18px;
        }
        .info span {
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            width: 100%;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Pembayaran Sukses!</h2>

    <div class="info">
        <p><span>NIM:</span> <?= htmlspecialchars($nim) ?></p>
        <p><span>Nama:</span> <?= htmlspecialchars($nama) ?></p>
        <p><span>Nominal Pembayaran:</span> Rp <?= number_format($nominal, 0, ',', '.') ?></p>
    </div>

    <a href="login_warga.php" class="btn">Kembali ke Halaman Utama</a>
</div>

</body>
</html>

<?php
// Reset session pembayaran_sukses agar tidak tampil lagi setelah refresh
$_SESSION['pembayaran_sukses'] = false;
?>
