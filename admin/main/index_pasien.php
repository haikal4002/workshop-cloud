<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
    include "../template/head.php";
?>
<?php
    include "../template/sidebar.php";
?>
<?php
    include "../template/top-bar.php";
    
    $sql = "SELECT * FROM pasien";
    $result = mysqli_query($conn, $sql);
?>


<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Data Pasien</h1>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Jenis Kelamin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Tampilkan data jika ada
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . $row['id_pasien'] . "</td>
                            <td>" . $row['nama_pasien'] . "</td>
                            <td>" . date("d-m-Y", strtotime($row['tanggal_lahir'])) . "</td>
                            <td>" . $row['alamat'] . "</td>
                            <td>" . $row['no_telepon'] . "</td>
                            <td>" . ($row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') . "</td>
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
