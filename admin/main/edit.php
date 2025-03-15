    <?php 
    // Menyertakan file yang diperlukan
    include '../template/head.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
    include '../template/sidebar.php';
    include '../template/top-bar.php';

    if (isset($_POST['simpan'])) {
        $nim = mysqli_real_escape_string($conn, $_POST['nim']);
        $nama=$_POST['nama'];
        $jurusan=$_POST['jurusan'];
        $alamat=$_POST['alamat'];
        $jenis_kelamin=$_POST['jenis_kelamin'];
        $no_kamar=$_POST['no_kamar'];
        $nama_pengurus=$_POST['nama_pengurus'];
        $nama_pengurus=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM pengurus WHERE nama_pengurus='$nama_pengurus'"));
        // var_dump($nama_pengurus);
        $nim_pengurus=$nama_pengurus['nim_pengurus'];
        // echo $nim_pengurus;
        $result3=mysqli_query($conn,"UPDATE warga_asrama SET nim_warga='$nim',jurusan_warga='$jurusan',alamat_warga='$alamat',jenis_kelamin_warga='$jenis_kelamin',no_kamar='$no_kamar',nim_pengurus='$nim_pengurus',nama_warga='$nama' WHERE nim_warga='{$_SESSION['nim_warga']}'");
        if ($result3) { 
            unset($_SESSION['nim_warga']);
            echo "<script>alert('Data berhasil diubah!'); window.location.href='data.php';</script>";
            
        }
    }    
    // Cek apakah parameter 'nim' ada di URL
    if (isset($_GET['nim'])) {
        $nim = mysqli_real_escape_string($conn, $_GET['nim']);
        
        // Query untuk mendapatkan data warga berdasarkan NIM
        $sql = "SELECT * FROM warga_asrama, pengurus WHERE nim_warga = '$nim'";
        $result = $conn->query($sql);

    
        // Periksa apakah data ditemukan
        if ($result && $data = mysqli_fetch_assoc($result)) {
            // Menyimpan data dari database ke variabel
            $nim_warga = htmlspecialchars($data['nim_warga']);
            $_SESSION['nim_warga'] = $nim_warga;
            $nama_warga = htmlspecialchars($data['nama_warga']);
            $jurusan_warga = htmlspecialchars($data['jurusan_warga']);
            $alamat_warga = htmlspecialchars($data['alamat_warga']);
            $jenis_kelamin_warga = htmlspecialchars($data['jenis_kelamin_warga']);
            $no_kamar = htmlspecialchars($data['no_kamar']);
            $nama_pengurus = htmlspecialchars($data['nama_pengurus']);
            
            ?>

            <h1 class="mb-4 text-center bg-primary text-white">Edit Data Warga</h1>
            <!-- Form untuk menampilkan dan mengedit data -->
            <form method="POST" action="edit.php" class="row g-3">
                <div class="col-md-6">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" id="nim" name="nim" class="form-control" value="<?php echo $nim_warga; ?>">
                </div>
                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $nama_warga; ?>">
                </div>
                <div class="col-md-6">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input list='jurusan-list'type="text" id="jurusan" name="jurusan" class="form-control" value="<?php echo $jurusan_warga; ?>">
                    <datalist id="jurusan-list">
                    <option value="S1 Ilmu Hukum"></option>
                    <option value="S1 Manajemen"></option>
                    <option value="S1 Akuntansi"></option>
                    <option value="S1 Ekonomi Pembangunan"></option>
                    <option value="S1 Agroteknologi"></option>
                    <option value="S1 Agribisnis"></option>
                    <option value="S1 Teknologi Ilmu Pertanian"></option>
                    <option value="S1 Ilmu Kelautan"></option>
                    <option value="S1 Manajemen Sumberdaya Perairan"></option>
                    <option value="S1 Teknik Informatika"></option>
                    <option value="S1 Sistem Informasi"></option>
                    <option value="S1 Teknik Industri"></option>
                    <option value="S1 Teknik Elektro"></option>
                    <option value="S1 Teknik Mekatronika"></option>
                    <option value="S1 Teknik Mesin"></option>
                    <option value="S1 Sosiologi"></option>
                    <option value="S1 Ilmu Komunikasi"></option>
                    <option value="S1 Sastra Inggris"></option>
                    <option value="S1 Psikologi"></option>
                    <option value="S1 Pendidikan Guru Sekolah Dasar"></option>
                    <option value="S1 Pendidikan Anak Usia Dini"></option>
                    <option value="S1 Pendidikan Ilmu Pengetahuan Alam"></option>
                    <option value="S1 Pendidikan Informatika"></option>
                    <option value="S1 Pendidikan Bahasa dan Sastra Indonesia"></option>
                    <option value="S1 Hukum Bisnis Syariah"></option>
                    <option value="S1 Ekonomi Syariah"></option>
                </datalist>
                </div>
                <div class="col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" value="<?php echo $alamat_warga; ?>">
                </div>
                <div class="col-md-6">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                        <option value="Laki-laki" <?php if ($jenis_kelamin_warga === 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php if ($jenis_kelamin_warga === 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="no_kamar" class="form-label">No Kamar</label>
                    <input list="kamar" type="text" id="no_kamar" name="no_kamar" class="form-control" value="<?php echo $no_kamar; ?>">
                    <datalist id="kamar">
                    <?php 
                    $result4 = mysqli_query($conn, "SELECT * FROM kamar");
                    foreach ($result4 as $kamar): ?>     
                        <option value="<?= htmlspecialchars($kamar['no_kamar']); ?>">
                    <?php endforeach; ?>
                </datalist>

                </div>
                <div class="col-md-6">
                <label for="nama_pengurus" class="form-label">Nama Pengurus</label>
                <input list="nama_pengurus_list" id="nama_pengurus" name="nama_pengurus" class="form-control" value="<?php echo $nama_pengurus; ?>">
                <datalist id="nama_pengurus_list">
                    <?php 
                    $result2 = mysqli_query($conn, "SELECT * FROM pengurus");
                    foreach ($result2 as $pengurus): ?>     
                        <option value="<?= htmlspecialchars($pengurus['nama_pengurus']); ?>">
                    <?php endforeach; ?>
                </datalist>
                </div>
                <div class="col-12">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
            <?php
        } else {
            echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Parameter NIM tidak diberikan.</div>";
    }
    ?>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

