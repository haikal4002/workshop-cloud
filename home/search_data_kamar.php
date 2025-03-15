<?php require 'assets/header.php'; ?>
<?php 
    include '../connect.php';
    // include 'session_check.php';
    
    $error_search = "";
    if(isset($_POST['search'])){
        $search = $_POST['input_search'];
        $query = mysqli_query($conn, "SELECT * FROM warga_asrama, kamar, gedung WHERE warga_asrama.no_kamar = kamar.no_kamar AND kamar.id_gedung = gedung.id_gedung AND nama_warga='$search'");
        $query2 = mysqli_query($conn, "SELECT * FROM kamar, gedung WHERE kamar.id_gedung = gedung.id_gedung AND nama_gedung='$search'");
        $query3 = mysqli_query($conn, "SELECT * FROM kamar, gedung WHERE  kamar.id_gedung = gedung.id_gedung AND no_kamar='$search'");
        
        if(mysqli_num_rows($query) > 0){
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        }
        elseif(mysqli_num_rows($query2) > 0){
            $result = mysqli_fetch_all($query2, MYSQLI_ASSOC);
        }
        elseif(mysqli_num_rows($query3) > 0){
            $result = mysqli_fetch_all($query3, MYSQLI_ASSOC);
        }
        else{
            $error_search = "data tidak ditemukan";
        }
    }
    
    if(isset($_POST['filter_tampilkan'])){
        if(isset($_POST['status_kamar']) && isset($_POST['jumlah'])){
            $search = $_POST['status_kamar'];
            $jumlah = $_POST['jumlah'];

            $jumlah_warga_kamar = mysqli_query($conn, "SELECT *, COUNT(warga_asrama.no_kamar) AS jumlah_penghuni FROM warga_asrama JOIN kamar ON warga_asrama.no_kamar = kamar.no_kamar 
            JOIN gedung ON kamar.id_gedung = gedung.id_gedung WHERE kamar.status_kamar = '$search' GROUP BY kamar.no_kamar HAVING jumlah_penghuni = '$jumlah'");
            if(mysqli_num_rows($jumlah_warga_kamar) > 0){
                $result = mysqli_fetch_all($jumlah_warga_kamar, MYSQLI_ASSOC);
            }
            else{
                $error_search = "data tidak ditemukan";
            }
        }
        if(isset($_POST['status_kamar']) && !isset($_POST['jumlah'])){
            $search = $_POST['status_kamar'];
            $query4 = mysqli_query($conn, "SELECT * FROM kamar, gedung WHERE kamar.id_gedung = gedung.id_gedung AND status_kamar='$search'");
    
            if(mysqli_num_rows($query4) > 0){
                $result = mysqli_fetch_all($query4, MYSQLI_ASSOC);
            }
            else{

                $error_search = "data tidak ditemukan";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searching Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        <?php include 'assets/style.css'; ?>
    </style>
</head>
<body>
    <div class="d-flex justify-content-around mt-5">
        <div>
            <button class="btn btn-primary" onclick="window.location.href='kamar.php'">Kembali</button>
        </div>
        <div class="input-group flex-nowrap kip"  style="width: 25%;">
            <form action="" method="post" class="w-100">
                <div class="d-flex w-100">
                    <input type="text" class="form-control w-100" placeholder="Search nama/gedung/kamar" aria-label="Username" aria-describedby="addon-wrapping" name="input_search">
                    <button class="input-group-text" id="addon-wrapping" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <div>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#mymodal"><span class="fa-solid fa-filter"></span> <span>Filter</span></button>
        </div>
    </div>
    <div class="text-center mt-2 text-danger">
        <p><?= $error_search; ?></p>
    </div>
    <?php if(isset($_POST['search']) && $error_search == "" || (isset($_POST['filter_tampilkan']) && isset($_POST['status_kamar']))): ?>
        <?php if($error_search == ""): ?>
            <div class="container mt-5">
                <div class="row">
                <?php foreach($result as $data): ?>
                    <?php 
                        if ($data['status_kamar'] == 'Tersedia'){
                            $statusColor = '#219B9D';
                        } elseif ($data['status_kamar'] == 'Kosong') {
                            $statusColor = '#1F509A';
                        } else {
                            $statusColor = '#D91656';
                        }
                
                        $no_kamar = $data['no_kamar'];
                        $sql_penghuni = "SELECT COUNT(*) AS jumlah_penghuni FROM warga_asrama WHERE no_kamar = '$no_kamar'";
                        $result_penghuni = mysqli_query($conn, $sql_penghuni);
                        $penghuni = mysqli_fetch_assoc($result_penghuni);
                        $jumlah_penghuni = $penghuni['jumlah_penghuni'];
                
                        $kapasitas_kamar = 6;
                        $tersedia = $kapasitas_kamar - $jumlah_penghuni;    
                    ?>
                
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg outer-card" style="background-color: #E2F4FD;">
                        <h4 class="card-header" style="width: 100%; text-align: center; background-color: #084B83; color: white;">Kamar</h4>
                        <h5 class="card-title p-2" style="width: 100%; text-align: center; color: white; background-color: #17689A;"><?= $no_kamar ?></h5>
                            <div class="card-body d-flex flex-column align-items-center">
                                <p class="card-text fw-bold">Gedung: <?= $data['nama_gedung'] ?>  </p>
                                <p class="card-text fw-bold p-1" style="color: black">Status : <span class="p-1" style="background-color: <?= $statusColor ?>; color: white;"> <?= $data['status_kamar']  ?></span></p>
                                <p class="card-text fw-bold">Jumlah Penghuni: <?= $jumlah_penghuni ?> / <?= $kapasitas_kamar ?></p>
                                <p class="card-text fw-bold">Kamar Tersedia: <?= $tersedia ?></p>
                                <form action="detail_kamar.php" method="get">
                                    <input type="hidden" name="no_kamar" value="<?= $no_kamar ?>">
                                    <button type="submit" class="btn btn-primary">Lihat Detail Kamar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
            <div></div>
        <?php endif; ?>
    <?php endif; ?>
                
    <div class="modal" tabindex="-1" id="mymodal">
    <form action="" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header text-light" style="background-color: #4a90e2">
                <h5 class="modal-title">Filtering</h5>
                <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>Pilih terkait dengan status kamar:</div>
                <div>
                    <input type="radio" name="status_kamar" value="Kosong" id="empty">
                    <label for="Kosong">Kosong</label>
                </div>
                <div>
                    <input type="radio" name="status_kamar" value="Tersedia" id="tersedia">
                    <label for="tersedia">Tersedia</label>
                </div>
                <div id="jml_warga" class="mx-2">
                    <div>
                        <input type="radio" name="jumlah" value="1" id="tersedia">
                        <label for="tersedia">1 Warga</label>
                    </div>
                    <div>
                        <input type="radio" name="jumlah" value="2" id="tersedia">
                        <label for="tersedia">2 Warga</label>
                    </div>
                    <div>
                        <input type="radio" name="jumlah" value="3" id="tersedia">
                        <label for="tersedia">3 Warga</label>
                    </div>
                    <div>
                        <input type="radio" name="jumlah" value="4" id="tersedia">
                        <label for="tersedia">4 Warga</label>
                    </div>
                    <div>
                        <input type="radio" name="jumlah" value="5" id="tersedia">
                        <label for="tersedia">5 Warga</label>
                    </div>
                </div>
                <div>
                    <input type="radio" name="status_kamar" value="Penuh" id="Penuh">
                    <label for="Penuh">Penuh</label>
                </div>
            </div>
            <div class="modal-footer">
                
                    <button type="submit" class="btn btn-primary" name="filter_tampilkan">Tampilkan</button>
                
            </div>
            </div>
        </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var button_model = document.getElementById('jml_warga');
        var tersedia = document.getElementById('tersedia');
        var penuh = document.getElementById('Penuh');

        tersedia.addEventListener('click', function(){
            button_model.style.display = "block";
        });
        penuh.addEventListener('click', function(){
            button_model.style.display = "none";
        })
    </script>
</body>
</html>
<?php
    include "assets/footer.php";
?>