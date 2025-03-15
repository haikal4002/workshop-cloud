<?php require './assets/header.php';
include '../connect.php';
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
    <table class="table table-striped table-bordered mt-4">
        <thead class="table-">
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Dosen Pengajar</th>
                <th>Materi</th>
                <th>Jadwal</th>
            </tr>
            </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Kajian Fiqih</td>
                <td>Dr. H. Ahmad</td>
                <td>Fiqih tharah</td>
                <td>Senin, 18.00 WIB</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Kajian Akhlak</td>
                <td>Dr. Mukidin</td>
                <td>Akhlak seorang mahasiswa</td>
                <td>Selasa, 18.00 WIB</td>
            </tr>
            <?php 
                $nim=$_SESSION['nim'];
                $result = mysqli_query($conn, "SELECT * FROM ekstrakulikuler,dosen_pengajar,warga_ekstrakulikuler where warga_ekstrakulikuler.id_ekstrakulikuler=ekstrakulikuler.id_ekstrakulikuler AND ekstrakulikuler.dosen_NIP=dosen_pengajar.nip");
                $no=3;
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $no++ . "</th>";
                    echo "<td>" . $row['nama_ekstrakulikuler'] . "</td>";
                    echo "<td>" . $row['nama_dosen'] . "</td>";
                    echo "<td>" . $row['materi'] . "</td>";
                    echo "<td>" . $row['jadwal_ekstrakulikuler'] . " WIB</td>";
                    echo "</tr>";
                }           
            ?>
    </table>
</body>
</html>
<?php require './assets/footer.php'; ?>