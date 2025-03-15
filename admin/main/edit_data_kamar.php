<?php 
    include '../template/head.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
    include '../template/sidebar.php';
    include '../template/top-bar.php';

    $success = null;
    $no_kamar = $_GET['kamar'];
    $nim = $_GET['nim'];
    
    $query = mysqli_query($conn, "SELECT * FROM warga_asrama WHERE no_kamar='$no_kamar' AND nim_warga='$nim'");
    $result = mysqli_fetch_assoc($query);

    $query_kamar = mysqli_query($conn, "SELECT * FROM kamar");
    $data_1 = mysqli_fetch_all($query_kamar, MYSQLI_ASSOC);

    $query_pengurus = mysqli_query($conn, "SELECT * FROM pengurus");
    $data_2 = mysqli_fetch_all($query_pengurus, MYSQLI_ASSOC);

    if(isset($_POST['save'])){
        $kamar = $_POST['kamar'];
        $pengurus = $_POST['pengurus'];
        if($kamar != "none" && $pengurus != "none"){
            $update = mysqli_query($conn, "UPDATE warga_asrama SET no_kamar = '$kamar', nim_pengurus = '$pengurus' WHERE nim_warga = '$nim'");
            $success = true;
            $_SESSION['status'] = true;
        }else{
            $success = true;
            $_SESSION['status'] = false;
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <form action="" method="post">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card shadow-lg" style="width: 30%; background-color: #F6F5F2;">
                <div class="card-header mt-2" style="background-color:#F0EBE3 ;"><h1 class="h3">Warga <?= $result['nama_warga']?></h1></div>
                <div class="card-body">
                    <div class="mb-1">
                        <label for="" class="form-label">No Kamar</label>
                        <select name="kamar" id=""class="form-select form-control-md bg-light" style="width: 100%;">
                            <option value="none">~~Pilih Kamar~~</option>
                            <?php foreach($data_1 as $kamar):?>
                                <option value="<?= $kamar['no_kamar'] ?>" <?= isset($no_kamar) && $no_kamar == $kamar['no_kamar'] ? 'selected' : "" ?>><?= $kamar['no_kamar'] ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Pengurus</label>
                        <select name="pengurus" id=""class="form-select form-control-md bg-light" style="width: 100%;">
                            <option value="none">~~Pilih Pengurus~~</option>
                            <?php foreach($data_2 as $pengurus):?>
                                <option value="<?= $pengurus['nim_pengurus'] ?>" <?= !empty($pengurus['nim_pengurus']) ? 'selected' : "" ?>><?= $pengurus['nama_pengurus'] ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-success" type="submit" name="save">Simpan</button>
                        <button class="btn btn-danger" type="button" onclick="window.location.href='master_detail_kamar.php'">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Edit Kamar</h5>
                </div>
                <div class="modal-body text-center">
                    <?php if($_SESSION['status'] == true): ?>
                        <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
                        <p>Kamar Warga berhasil diperbarui!</p>
                    <?php else:  
                        echo "<i class='fa fa-times-circle fa-5x text-danger mb-3'></i>";
                        echo "<p>Kamar gagal diperbarui!</p>"; 
                    ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="master_detail_kamar.php" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if ($success !== null): ?>
            var myModal = new bootstrap.Modal(document.getElementById('statusModal'));
            myModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
