<?php
require 'assets/header.php'; 
include '../connect.php';



// Proses penyimpanan data ke database
if (isset($_GET['submit'])) {
    // Ambil data dari session dan GET
    $id = isset($_SESSION['nim']) ? $_SESSION['nim'] : null;
    $no = isset($_GET['no']) ? $_GET['no'] : null;

    // Validasi data
    if ($id && $no) {
        // Escape input untuk keamanan SQL
        $id = mysqli_real_escape_string($conn, $id);
        $no = mysqli_real_escape_string($conn, $no);

        // Cek apakah data sudah ada di database
        $checkQuery = "SELECT * FROM warga_ekstrakulikuler WHERE nim_warga = '$id' AND id_ekstrakulikuler = '$no'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "<script>alert('Anda sudah memilih ekstrakurikuler ini!');</script>";
        } else {
            // Query untuk memasukkan data
            $query = "INSERT INTO warga_ekstrakulikuler (nim_warga, id_ekstrakulikuler) VALUES ('$id', '$no')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Ekstrakurikuler berhasil dipilih!');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Data tidak lengkap.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asrama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        <?php include 'assets/style.css'; ?>
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Pilih Ekstrakulikuler</h2>
        <div class="row">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM ekstrakulikuler INNER JOIN dosen_pengajar ON ekstrakulikuler.dosen_NIP = dosen_pengajar.nip");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $checkQuery = "SELECT * FROM warga_ekstrakulikuler WHERE nim_warga = '{$_SESSION['nim']}' AND id_ekstrakulikuler = '{$row['id_ekstrakulikuler']}'";
                    $checkResult = mysqli_query($conn, $checkQuery);
                    $alreadySelected = mysqli_num_rows($checkResult) > 0;
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg outer-card" style="background-color: #E2F4FD;">
                            <h4 class="card-header text-center" style="background-color: #084B83; color: white;">Ekstrakulikuler</h4>
                            <h5 class="card-title text-center p-2" style="color: white; background-color: #17689A;"><?= htmlspecialchars($row['nama_ekstrakulikuler']); ?></h5>
                            <div class="card-body text-center">
                                <p class="card-text fw-bold p-1" style="color: black;">Jadwal: 
                                    <span class="p-1" style="background-color:#219B9D; color: white;"><?= htmlspecialchars($row['jadwal_ekstrakulikuler']); ?></span>
                                </p>
                                <p class="card-text fw-bold">Dosen Pengajar: <?= htmlspecialchars($row['nama_dosen']); ?></p>
                                <p class="card-text fw-bold">Materi: <?= htmlspecialchars($row['materi']); ?></p>
                                <p class="card-text fw-bold">Status: <?= htmlspecialchars($row['status']); ?></p>
                                <?php if($row['status'] != 'Tersedia') {
                                    echo "<p class='text-danger fw-bold'>Ekstrakurikuler Tidak Tersedia</p>";
                                }
                                elseif ($alreadySelected) { ?>
                                    <p class="text-success fw-bold">Sudah Dipilih</p>
                                <?php } else { ?>
                                    <form action="" method="get">
                                        <input type="hidden" name="no" value="<?=$row['id_ekstrakulikuler']; ?>">
                                        <button type="submit" name="submit" class="btn btn-primary">Pilih</button>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                echo "<p class='text-center'>Tidak ada ekstrakurikuler tersedia.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php
    include "assets/footer.php"
?>
