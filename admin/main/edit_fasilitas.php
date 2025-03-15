<?php
    include "../template/head.php";
    include "../template/sidebar.php";
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
    include "../template/top-bar.php";
?>

<?php
// Ambil data fasilitas berdasarkan id yang diberikan
if (isset($_GET['id'])) {
    $id_fasilitas = $_GET['id'];
    $sql = "SELECT * FROM fasilitas WHERE id_fasilitas = '$id_fasilitas'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $fasilitas = $result->fetch_assoc();
    } else {
        echo "<script>alert('Fasilitas tidak ditemukan!'); window.location.href='manage_fasilitas.php';</script>";
    }
}

// Update fasilitas jika tombol simpan diklik
if (isset($_POST['update'])) {
    $id_fasilitas = $_POST['id_fasilitas'];
    $nama_fasilitas = $_POST['nama_fasilitas'];
    $jumlah_fasilitas = $_POST['jumlah_fasilitas'];
    $aturan_penggunaan = $_POST['aturan_penggunaan'];
    $id_gedung = $_POST['id_gedung'];

    $sql = "UPDATE fasilitas SET nama_fasilitas = '$nama_fasilitas', jumlah_fasilitas = '$jumlah_fasilitas', aturan_penggunaan = '$aturan_penggunaan', id_gedung = '$id_gedung' WHERE id_fasilitas = '$id_fasilitas'";

    if ($conn->query($sql) === TRUE) {
        // Menyimpan ID fasilitas yang diperbarui ke dalam file
        file_put_contents('last_updated.txt', $id_fasilitas);
    
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='manage_fasilitas.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}



$sql_gedung = "SELECT id_gedung, nama_gedung FROM gedung";
$result_gedung = $conn->query($sql_gedung);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fasilitas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            color: #003366;
        }

        input[type="text"], input[type="number"], select {
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
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Fasilitas</h2>
        <form method="POST">
            <input type="hidden" name="id_fasilitas" value="<?php echo $fasilitas['id_fasilitas']; ?>">
            <input type="text" name="nama_fasilitas" value="<?php echo $fasilitas['nama_fasilitas']; ?>" required>
            <input type="number" name="jumlah_fasilitas" value="<?php echo $fasilitas['jumlah_fasilitas']; ?>" required>
            <input type="text" name="aturan_penggunaan" value="<?php echo $fasilitas['aturan_penggunaan']; ?>" required>

            <label for="id_gedung">Pilih Gedung</label>
            <select name="id_gedung" required>
                <?php
                if ($result_gedung->num_rows > 0) {
                    while ($row_gedung = $result_gedung->fetch_assoc()) {
                        $selected = ($fasilitas['id_gedung'] == $row_gedung['id_gedung']) ? 'selected' : '';
                        echo "<option value='{$row_gedung['id_gedung']}' $selected>{$row_gedung['nama_gedung']}</option>";
                    }
                }
                ?>
            </select>

            <button type="submit" name="update">Simpan Perubahan</button>
        </form>
    </div>

</body>
</html>

<?php
$conn->close();
?>

