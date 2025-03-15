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
        rp.id_riwayat,
        p.nama_pasien,
        o.nama_obat,
        rp.penyakit,
        rp.tanggal_masuk,
        rp.tanggal_keluar
    FROM 
        riwayat_pasien rp
    JOIN 
        pasien p ON rp.id_pasien = p.id_pasien
    JOIN 
        obat o ON rp.id_obat = o.id_obat
    ORDER BY 
        rp.tanggal_masuk ASC";

$result = mysqli_query($conn, $sql);
?>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Riwayat Pasien</h1>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Riwayat</th>
                    <th>Nama Pasien</th>
                    <th>Nama Obat</th>
                    <th>Penyakit</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Tampilkan data jika ada
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . $row['id_riwayat'] . "</td>
                            <td>" . $row['nama_pasien'] . "</td>
                            <td>" . $row['nama_obat'] . "</td>
                            <td>" . $row['penyakit'] . "</td>
                            <td>" . date("d-m-Y", strtotime($row['tanggal_masuk'])) . "</td>
                            <td>" . ($row['tanggal_keluar'] ? date("d-m-Y", strtotime($row['tanggal_keluar'])) : '-') . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
    include "../template/script.php"
?>

