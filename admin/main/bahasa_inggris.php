<?php
    include "../template/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
?>
<?php
    include "../template/sidebar.php";
?>
<?php
    include "../template/top-bar.php";
    $sql = "
    SELECT 
        wa.nim_warga,
        wa.nama_warga,
        wa.jurusan_warga
    FROM 
        warga_ekstrakulikuler we
    INNER JOIN 
        warga_asrama wa ON we.nim_warga = wa.nim_warga
    INNER JOIN 
        ekstrakulikuler e ON we.id_ekstrakulikuler = e.id_ekstrakulikuler
    WHERE 
        e.id_ekstrakulikuler = '2'
";
$search = isset($_POST['search']) ? $_POST['search'] : '';
$searchBy = isset($_POST['search_by']) ? $_POST['search_by'] : 'nama';
// Jika ada pencarian, tambahkan kondisi
$base_query = "
    SELECT 
        wa.nim_warga, 
        wa.nama_warga, 
        wa.jurusan_warga 
    FROM 
        warga_asrama wa
    INNER JOIN 
        warga_ekstrakulikuler we ON wa.nim_warga = we.nim_warga
    WHERE 
        we.id_ekstrakulikuler = 2
";
if ($search) {
    $escaped_search = mysqli_real_escape_string($conn, $search);
    if ($searchBy == 'nama') {
        $base_query .= " AND wa.nama_warga LIKE '%$escaped_search%'";
    } elseif ($searchBy == 'nim') {
        $base_query .= " AND wa.nim_warga LIKE '%$escaped_search%'";
    }
}

// Eksekusi query
$result = mysqli_query($conn, $base_query);

// Ambil data hasil pencarian
$pendaftaran_data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pendaftaran_data[] = $row;
    }
}

if(isset($_POST['submit'])){
    $status=$_POST['status'];
    $jadwal=$_POST['jadwal'];
    $dosen=$_POST['dosen'];
        $materi=htmlspecialchars($_POST['materi']);
        $sql3="UPDATE ekstrakulikuler,dosen_pengajar  SET jadwal_ekstrakulikuler='$jadwal',nama_dosen='$dosen',status='$status',materi='$materi' WHERE id_ekstrakulikuler=2 AND ekstrakulikuler.dosen_NIP=dosen_pengajar.NIP";
        $result3=mysqli_query($conn,$sql3);
        if($result3){
            echo "<script>alert('Data berhasil')</script>
            <script>window.location.href='bahasa_inggris.php'</script>";

        }
    }
    $result = mysqli_query($conn, $sql);
    $sql2="SELECT * FROM ekstrakulikuler,dosen_pengajar WHERE id_ekstrakulikuler=2 AND ekstrakulikuler.dosen_NIP=dosen_pengajar.NIP";
    $result2=mysqli_fetch_array(mysqli_query($conn,$sql2));
    $status=$result2['status'];
?>
<h1 class="text-center mb-4 font-bold font-siz e-xl">Ekstrakulikuler Bahasa Inggris</h1>
<form action="bahasa_arab.php" method="POST">
    <div class="mb-3 row align-items-center">
        <label for="jadwal" class="col-sm-3 col-form-label">Jadwal:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="jadwal" name="jadwal" value="<?= $result2['jadwal_ekstrakulikuler'] ?>">
        </div>
    </div>

    <div class="mb-3 row align-items-center">
        <label for="dosen" class="col-sm-3 col-form-label">Dosen:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="dosen" name="dosen" value="<?= $result2['nama_dosen'] ?>">
        </div>
    </div>

    <div class="mb-3 row align-items-center">
        <label for="materi" class="col-sm-3 col-form-label">Materi:</label>
        <div class="col-sm-9">
            <textarea class="form-control" id="materi" name="materi" rows="4"><?= $result2['materi'] ?></textarea>
        </div>
    </div>

    <div class="mb-3 row align-items-center">
        <label for="status" class="col-sm-3 col-form-label">Status:</label>
        <div class="col-sm-9">
            <select class="form-select" id="status" name="status">
                <option value="Tersedia" <?=isset($status) && $status  == 'Tersedia' ? 'selected' : '' ;$status?>>Tersedia</option>
                <option value="Tidak Tersedia" <?= isset($status) && $status == 'Tidak Tersedia' ? 'selected' : '' ?>>Tidak Tersedia</option>
            </select>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary" name="submit" >Submit</button>
    </div>
</form>
<form method="POST" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?= htmlspecialchars($search) ?>">
                            <select name="search_by" class="form-control">
                                <option value="nama" <?= $searchBy == 'nama' ? 'selected' : '' ?>>Nama</option>
                                <option value="nim" <?= $searchBy == 'nim' ? 'selected' : '' ?>>NIM</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
<table class="table table-striped table-bordered mt-4">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope='col'>NIM</th>
            <th scope='col'>nama</th>
            <th scope='col'>jurusan</th>
            <th scope='col'>aksi</th>  
        </tr>
    </thead>
    <tbody>
<?php
        foreach ($pendaftaran_data as $row => $rows) {
?>
            <tr>
                <th scope="row"><?= $row+1 ?></th>
                <td><?= $rows['nim_warga'] ?></td>
                
                <td><?= $rows['nama_warga'] ?></td>
                <td><?= $rows['jurusan_warga'] ?></td>
                <td>
                    <a href="bahasa_arab.php?nim_warga=<?= $rows['nim_warga'] ?>" class="btn btn-danger"><button>Hapus</button></a>
                    <?php $r=$rows['nim_warga']; 
                    if (isset($_GET['nim_warga']))  {
                        $aku=mysqli_query($conn,"DELETE FROM warga_ekstrakulikuler WHERE nim_warga='$r' and id_ekstrakulikuler=1"); 
                        if($aku){
                            echo "<script>alert('Data berhasil dihapus') ;window.location.href='bahasa_arab.php'</script>";
                        }
                    }  ?>
                </td>
            </tr>
<?php
        }
    echo "</tbody>";
    include "../template/script.php"
?>
</table>
