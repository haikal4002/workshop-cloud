<?php 
include '../template/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
include '../template/sidebar.php';
include '../template/top-bar.php';
$input['jurusan']='';
?>
    <div class="container mt-5">
        <form action="data.php" method="get" class="p-4 border rounded shadow-sm">
            <div class="mb-3">
                <label for="jurusan" class="form-label">Search:</label>
                <input list="jurusan-list" name="jurusan" id="jurusan" class="form-control" placeholder="Pilih Jurusan" value="<?= isset($input['jurusan']) ? htmlspecialchars($input['jurusan']) : '' ?>">
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
            <button class="btn btn-primary w-100" type="submit">Cari</button>
        </form>
    </div>
<?php
if (isset($_GET['jurusan'])){
    $jurusan = $_GET['jurusan'];
    $input['jurusan'] = $jurusan;
    $sql = "SELECT * FROM warga_asrama,pengurus WHERE jurusan_warga='$input[jurusan]'";
    $result = mysqli_query($conn, $sql);
}else{
    $input['jurusan'] = '';
    $sql1="SELECT * FROM warga_asrama,pengurus where warga_asrama.nim_pengurus=pengurus.nim_pengurus"; 
    $result=mysqli_query($conn,$sql1);
}
if (isset($_GET['nim'])){
    $nim = $_GET['nim'];
    $sql2="DELETE from warga_ekstrakulikuler WHERE nim_warga='$nim'";
    $sql1="DELETE from pembayaran WHERE nim_warga='$nim'";
    $sql="DELETE from warga_asrama where nim_warga='$nim'";
    $query=mysqli_query($conn,$sql2);
    $query=mysqli_query($conn,$sql1);
    $query=mysqli_query($conn,$sql);
}
echo"<table class='table table-striped table-bordered mt-4'>
    <thead>
        <tr>
        <th scope='col'>No</th>
        <th scope='col'>NIM</th>
        <th scope='col'>Nama</th>
        <th scope='col'>Jurusan</th>
        <th scope='col'>Alamat</th>
        <th scope='col'>Jenis Kelamin</th>
        <th scope='col'>No Kamar</th>
        <th scope='col'>Pengurus</th>
        <th scope='col'>Aksi</th>
        </tr>
    </thead>
    <tbody>";

    foreach ($result as $index => $data) {
        echo "<tr>";
        echo "<th scope='row'>" . ($index + 1) . "</th>";
        echo "<td>" . $data['nim_warga'] . "</td>";
        echo "<td>" . $data['nama_warga'] . "</td>";
        echo "<td>" . $data['jurusan_warga'] . "</td>";
        echo "<td>" . $data['alamat_warga'] . "</td>";
        echo "<td>" . $data['jenis_kelamin_warga'] . "</td>";
        echo "<td>" . $data['no_kamar'] . "</td>";
        echo "<td>" . $data['nama_pengurus'] . "</td>";
        echo "<td>
                <a href='edit.php?nim=" . $data['nim_warga'] . "' class='btn btn-primary'>Edit</a>
                <a href='data.php?nim=" . $data['nim_warga'] . "' class='btn btn-danger'>Hapus</a>
            </td>";
        echo "</tr>";
    }
    echo "</tbody>
</table>";
?>
<?php
    include "../template/script.php"
?>