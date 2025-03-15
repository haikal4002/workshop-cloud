
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
include "../template/head.php";
?>
<?php
include "../template/sidebar.php";
?>
<?php
include "../template/top-bar.php";

$sql = "SELECT * FROM obat";
$result = mysqli_query($conn, $sql);
?>





<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Data Obat</h1>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Obat</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Tampilkan data jika ada
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . $row['id_obat'] . "</td>
                            <td>" . $row['nama_obat'] . "</td>
                            <td>" . $row['kategori_obat'] . "</td>
                            <td>Rp " . number_format($row['harga'], 2, ',', '.') . "</td>
                            <td>" . $row['stok'] . "</td>
                            <td>" . $row['deskripsi'] . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    </body>
</html>
<?php
    include "../template/script.php"
?>