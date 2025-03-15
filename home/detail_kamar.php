<?php require 'assets/header.php'; ?>
<?php
    include '../connect.php';
    // include 'session_check.php';

    if (isset($_GET['no_kamar'])) {
        $no_kamar = $_GET['no_kamar'];
    } else {
        die("No kamar tidak ditemukan!");
    }


    $sql_kamar = "SELECT * FROM kamar WHERE no_kamar = '$no_kamar'";
    $query = mysqli_query($conn, $sql_kamar);
    $result_kamar = mysqli_fetch_assoc($query);


    $sql_warga = "SELECT * FROM warga_asrama WHERE no_kamar = '$no_kamar'";
    $query2 = mysqli_query($conn, $sql_warga);
    $result_warga = mysqli_fetch_all($query2, MYSQLI_ASSOC);

    $query_kamar = mysqli_query($conn, "SELECT COUNT(no_kamar) AS JUMLAH_WARGA FROM warga_asrama WHERE no_kamar = '$no_kamar'");
    $result_kamar2 = mysqli_fetch_assoc($query_kamar);
    $data_kamar = $result_kamar2['JUMLAH_WARGA'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kamar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        td {
            text-align: left;
        }
        #kamar-1{
            background-color: #BCCCDC;
        }
        #kamar-2{
            background-color: #BCCCDC;
        }
        #kamar-3{
            background-color: #BCCCDC;
        }
        #kamar-4{
            background-color: #BCCCDC;
        }
        #kamar-5{
            background-color: #BCCCDC;
        }
        #kamar-6{
            background-color: #BCCCDC;
        }
    <?php 
        $count = 1;
        while ($count <= $data_kamar) {
            echo "#kamar-$count { background-color: #A1EEBD; }";
            $count++;
        }
    ?>
        <?php include 'assets/style.css'; ?> 
    </style>
</head>

<body>

    <main class="container mt-5">
        <h2 class="mb-4">Detail Kamar - <?= ($result_kamar['no_kamar']); ?></h2>
        <div class="d-flex gap-5">
            <div style="width: 60%;" class="d-flex align-items-center">
                <table class="table table-bordered">
                    <tr>
                        <th>No Kamar</th>
                        <td><?= ($result_kamar['no_kamar']); ?></td>
                    </tr>
                    <tr>
                        <th>Gedung</th>
                        <td><?= ($result_kamar['id_gedung']); ?></td>
                    </tr>
                    <tr>
                        <th>Status Kamar</th>
                        <td><?= ($result_kamar['status_kamar']); ?></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td><?= ($result_kamar['keterangan'] ?? 'Tidak ada keterangan'); ?></td>
                    </tr>
                </table>
            </div>
            <div style="width: 40%;" class="card main-card">
                <div class="mt-2 p-2 text-center">
                    <div>
                        <h4>Denah Kamar</h4>
                    </div>
                    <div>
                        <div class="mb-1 d-flex gap-2">
                            <div id="terisi"></div> <span>Terisi</span>
                        </div>
                        <div class="d-flex gap-2">
                            <div id="kosong"></div> <span>Kosong</span>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="denah_kamar">
                            <div class="info_kamar">
                                <img src="./assets/img/bed.png" alt="" style="width: 50px; padding: 3;" id="kamar-1">
                                <span>1</span>
                            </div>
                            <div class="mt-3">
                                <img src="./assets/img/bed.png" alt="" style="width: 50px; padding: 3;" id="kamar-2">
                                <span>2</span>
                            </div>
                            <div class="mt-5">
                                <img src="./assets/img/bed.png" alt="" style="width: 50px; padding: 3;" id="kamar-3">
                                <span>3</span>
                            </div>
                            <div class="mt-5">
                                <img src="./assets/img/bed.png" alt="" style="width: 50px; padding: 3;" id="kamar-4">
                                <span>4</span>
                            </div>
                            <div class="mt-3">
                                <img src="./assets/img/bed.png" alt="" style="width: 50px; padding: 3;" id="kamar-5">
                                <span>5</span>
                            </div>
                            <div>
                                <img src="./assets/img/bed.png" alt="" style="width: 50px; padding: 3;" id="kamar-6">
                                <span>6</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-5">Warga Asrama yang Menggunakan Kamar Ini</h3>
        <?php if (count($result_warga) >  0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th class="text-center">NIM Warga</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Jurusan</th>
                        <?php if($_SESSION['role'] == "pengurus"): ?>
                                <th>Action</th>
                            <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $position = 0 ?>
                    <?php while ($position < count($result_warga)): ?>
                        <tr>
                            <td><?= $position+1 ?></td>
                            <td><?= ($result_warga[$position]['nim_warga']); ?></td>
                            <td><?= ($result_warga[$position]['nama_warga']); ?></td>
                            <td><?= ($result_warga[$position]['jurusan_warga']); ?></td>
                        </tr>
                        <?php $position+=1; ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-danger">Tidak ada warga yang menggunakan kamar ini.</p>
        <?php endif; ?>

        <a href="kamar.php" class="btn btn-primary">Kembali</a>
    </main>
</body>

</html>
<?php
    include "assets/footer.php"
?>