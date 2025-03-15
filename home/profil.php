<?php
    include '../connect.php';
    // include 'session_check.php';
    ?>
    <?php require 'assets/header.php'; ?>
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
        /* Include the CSS file here */
        <?php include 'assets/style.css'; ?>
    </style>
</head>

<body>

    <!-- Konten Profil Pengguna -->
    <main>
        <div class="profile-card">
            <div class="profile-header">
                <h2>Profil Pengguna</h2>
                <p><i class="fas fa-user-circle"></i> Pengguna ID: <?php echo $_SESSION['nim']; ?></p>
            </div>
            <div class="profile-body">
                <p><strong>Nama:</strong> <?php echo $_SESSION['nama']; ?></p>
                <p><strong>Jurusan:</strong> <?php echo $_SESSION['jurusan']; ?></p>
                <p><strong>Alamat:</strong> <?php echo $_SESSION['alamat']; ?></p>
                <p><strong>Jenis Kelamin:</strong> <?php echo $_SESSION['jenis_kelamin']; ?></p>
                <p><strong>No Kamar:</strong> <?php echo $_SESSION['no_kamar']; ?></p>
                <p><strong>No hp:</strong> <?php echo $_SESSION['no_hp']; ?></p>
                <p><strong>status:</strong> <?php echo $_SESSION['role']; ?></p>
                <a href="edit_profile.php" class="btn">Edit Profil</a>
            </div>
        </div>
    </main>
</body>

</html>
<?php
    include "assets/footer.php";
?>