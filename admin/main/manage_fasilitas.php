<?php
    include "../template/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
?>
<?php
    include  "../template/sidebar.php";
?>

<?php
    include  "../template/top-bar.php";
?>

<?php
if (isset($_POST['tambah'])) {
    $id_fasilitas = $_POST['id_fasilitas'];
    $nama = $_POST['nama_fasilitas'];
    $jumlah = $_POST['jumlah_fasilitas'];
    $aturan = $_POST['aturan_penggunaan'];
    $id_gedung = $_POST['id_gedung'];

    $sql = "INSERT INTO fasilitas (id_fasilitas, nama_fasilitas, jumlah_fasilitas, aturan_penggunaan, id_gedung)
            VALUES ('$id_fasilitas', '$nama', '$jumlah', '$aturan', '$id_gedung')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql = "DELETE FROM fasilitas WHERE id_fasilitas = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM fasilitas";
$result = $conn->query($sql);

$sql_gedung = "SELECT id_gedung, nama_gedung FROM gedung";
$result_gedung = $conn->query($sql_gedung);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Fasilitas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            color: #003366;
        }

        input[type="text"], input[type="number"], select, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #003366;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #00509e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #003366;
            color: white;
        }

        a.btn {
            padding: 8px 16px;
            background-color: #0066cc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a.btn:hover {
            background-color: #00509e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Fasilitas</h2>
        <form method="POST">
            <input type="text" name="id_fasilitas" placeholder="ID Fasilitas" required>
            <input type="text" name="nama_fasilitas" placeholder="Nama Fasilitas" required>
            <input type="number" name="jumlah_fasilitas" placeholder="Jumlah Fasilitas" required>
            
            <!-- Aturan Penggunaan: Menggunakan textarea untuk input multi-baris -->
            <label for="aturan_penggunaan">Aturan Penggunaan</label>
            <textarea name="aturan_penggunaan" rows="5" placeholder="Tuliskan aturan penggunaan di sini..." required></textarea>

            <label for="id_gedung">Pilih Gedung</label>
            <select name="id_gedung" required>
                <option value="">Pilih Gedung</option>
                <?php
                if ($result_gedung->num_rows > 0) {
                    while ($row_gedung = $result_gedung->fetch_assoc()) {
                        echo "<option value='{$row_gedung['id_gedung']}'>{$row_gedung['nama_gedung']}</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" name="tambah">Tambah</button>
        </form>

        <h2>Daftar Fasilitas</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Aturan</th>
                        <th>Gedung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_fasilitas']; ?></td>
                            <td><?php echo $row['nama_fasilitas']; ?></td>
                            <td><?php echo $row['jumlah_fasilitas']; ?></td>
                            <td><?php echo nl2br($row['aturan_penggunaan']); ?></td> <!-- Menampilkan aturan dengan baris baru -->
                            <td>
                                <?php
                                $gedung_sql = "SELECT nama_gedung FROM gedung WHERE id_gedung = '{$row['id_gedung']}'";
                                $gedung_result = $conn->query($gedung_sql);
                                $gedung_row = $gedung_result->fetch_assoc();
                                echo $gedung_row['nama_gedung'];
                                ?>
                            </td>
                            <td>
                                <a href="edit_fasilitas.php?id=<?php echo $row['id_fasilitas']; ?>" class="btn">Edit</a>
                                <a href="?hapus=<?php echo $row['id_fasilitas']; ?>" class="btn">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Belum ada data fasilitas.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
<?php include "../template/script.php";?>

