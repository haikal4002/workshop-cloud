<?php

$beritaEdit = null;
if (isset($_GET['edit_id'])) {
    // Simulasikan pengambilan data berita yang akan diedit
    $beritaEdit = ['id' => $_GET['edit_id'], 'judul' => 'Berita yang diedit', 'konten' => 'Isi berita yang diedit'];
}

// Penanganan penyimpanan berita baru atau edit
if (isset($_POST['simpan_berita'])) {
    // Simulasikan penyimpanan berita
    echo "Berita berhasil disimpan: " . $_POST['judul'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asrama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    <?php include 'assets/style.css'; ?>
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Buat atau Edit Berita</h1>

        <form method="POST">
            <div class="mb-3">
                <input type="text" name="judul" class="form-control" placeholder="Judul Berita" value="<?php echo $beritaEdit ? $beritaEdit['judul'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <textarea name="konten" class="form-control" placeholder="Isi Berita" required><?php echo $beritaEdit ? $beritaEdit['konten'] : ''; ?></textarea>
            </div>
            <button type="submit" name="simpan_berita" class="btn btn-success">Simpan Berita</button>
        </form>
    </div>

    <!-- Link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
