<?php
include '../connect.php';
session_start();

// Redirect if not logged in or no payment session
if (!isset($_SESSION['pendaftaran']['NIM']) || !isset($_SESSION['pembayaran'])) {
    header('Location: login_warga.php');
    exit();
}

$nim = $_SESSION['pendaftaran']['NIM'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate file upload
    if (!isset($_FILES['bukti_pembayaran']) || $_FILES['bukti_pembayaran']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['file'] = 'Bukti pembayaran harus diunggah.';
    } else {
        $file = $_FILES['bukti_pembayaran'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $max_size = 5 * 1024 * 1024; // 5MB

        // Validate file type
        if (!in_array($file['type'], $allowed_types)) {
            $errors['file'] = 'File harus berupa gambar (JPG, JPEG, atau PNG).';
        }

        // Validate file size
        if ($file['size'] > $max_size) {
            $errors['file'] = 'Ukuran file maksimal 5MB.';
        }

        if (empty($errors)) {
            // Create directory if it doesn't exist
            $upload_dir = 'bukti_pembayaran/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Generate unique filename with format: metode_pembayaran_nim_timestamp.extension
            $metode_pembayaran = $_SESSION['pembayaran']['metode_pembayaran'];
            $metode_pembayaran_sanitized = preg_replace('/[^a-zA-Z0-9]/', '_', $metode_pembayaran); // Replace non-alphanumeric characters with _
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = $metode_pembayaran_sanitized . '_' . $nim . '_' . time() . '.' . $extension;
            $target_path = $upload_dir . $filename;

            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                // Get payment details from session
                $nominal = $_SESSION['pembayaran']['nominal'];
                $tanggal_pembayaran = $_SESSION['pembayaran']['tanggal_pembayaran'];

                // Generate id_pembayaran using COUNT + 1
                $query_count = "SELECT COUNT(*) AS total FROM pembayaran";
                $result = mysqli_query($conn, $query_count);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $id_pembayaran = $row['total'] + 1;

                    // Insert payment data into database
                    $tambah_pembayaran = "INSERT INTO pembayaran (id_pembayaran, nim_warga, nominal, tanggal_pembayaran, metode_pembayaran, bukti_pembayaran) 
                                          VALUES ('$id_pembayaran', '$nim', '$nominal', '$tanggal_pembayaran', '$metode_pembayaran', '$target_path')";
                    if (mysqli_query($conn, $tambah_pembayaran)) {
                        echo "<script>
                            alert('Bukti pembayaran berhasil diunggah dan pembayaran tercatat!');
                            window.location.href = 'success.php';
                        </script>";
                        $_SESSION['pembayaran_sukses'] = true;
                        exit();
                    } else {
                        $errors['db'] = 'Gagal menyimpan data ke database. Error: ' . mysqli_error($conn);
                    }
                } else {
                    $errors['count'] = 'Gagal menghitung jumlah pembayaran.';
                }
            } else {
                $errors['upload'] = 'Gagal mengunggah file.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Pembayaran</title>
    <style>
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Bukti Pembayaran</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bukti_pembayaran">Pilih File Bukti Pembayaran:</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                <?php if (isset($errors['file'])): ?>
                    <div class="error"><?php echo $errors['file']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <button type="submit">Upload Bukti Pembayaran</button>
                <button type="button" onclick="window.location.href='pembayaran.php?username=<?php echo $nim; ?>'">Kembali</button>
            </div>
            <?php if (isset($errors['db'])): ?>
                <div class="error"><?php echo $errors['db']; ?></div>
            <?php endif; ?>
            <?php if (isset($errors['count'])): ?>
                <div class="error"><?php echo $errors['count']; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
