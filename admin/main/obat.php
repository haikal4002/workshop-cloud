
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
include "../template/head.php";
?>
<?php
include "../template/sidebar.php";
?>
<?php
include "../template/top-bar.php";


if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM obat WHERE id_obat='$id'";
    mysqli_query($koneksi, $sql);
    header("Location: obat.php");
}

$sql = "SELECT * FROM obat";
$result = mysqli_query($conn, $sql);
?>


<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Data Obat</h1>
        <a href="tambah_obat.php" class="btn btn-primary mb-3">Tambah Obat</a>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Obat</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . $row['id_obat'] . "</td>
                            <td>" . $row['nama_obat'] . "</td>
                            <td>" . $row['kategori_obat'] . "</td>
                            <td>Rp " . number_format($row['harga'], 2, ',', '.') . "</td>
                            <td>" . $row['stok'] . "</td>
                            <td>" . $row['deskripsi'] . "</td>
                            <td>
                                <a href='edit_obat.php?id=" . $row['id_obat'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='?hapus=" . $row['id_obat'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
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
