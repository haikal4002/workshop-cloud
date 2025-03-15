<?php
session_start();
include '../connect.php';

$errors = [];
$input = [
    'NIM' => '',
    'password' => '',
    'nama' => '',
    'alamat' => '',
    'hp' => '',
    'kelamin' => '',
    'jurusan' => ''
];

if (isset($_POST['tambah'])) {
    // Mengambil data input
    foreach ($input as $key => $value) {
        $input[$key] = trim($_POST[$key] ?? '');
    }

    // Validasi input
    if (empty($input['NIM'])) {
        $errors['NIM'] = "NIM harus diisi.";
    } else {
        // Check if NIM already exists in pendaftaran table
        $nim = mysqli_real_escape_string($conn, $input['NIM']);
        $check_nim = "SELECT nim_pendaftaran FROM pendaftaran, warga_asrama WHERE nim_pendaftaran = '$nim' OR nim_warga= '$nim'";
        $result = mysqli_query($conn, $check_nim);
        
        if (mysqli_num_rows($result) > 0) {
            $errors['NIM'] = "NIM sudah terdaftar dalam sistem pendaftaran atau sudah terdaftar.";
        }
    }
    if (empty($input['password'])) {
        $errors['password'] = "Password harus diisi.";
    }
    if (empty($input['nama'])) {
        $errors['nama'] = "Nama harus diisi.";
    }
    if (empty($input['alamat'])) {
        $errors['alamat'] = "Alamat harus diisi.";
    }
    if (empty($input['hp'])) {
        $errors['hp'] = "Nomor HP harus diisi.";
    }
    if (empty($input['kelamin'])) {
        $errors['kelamin'] = "Jenis kelamin harus dipilih.";
    }
    if (empty($input['jurusan'])) {
        $errors['jurusan'] = "Jurusan harus dipilih.";
    }

    // Jika tidak ada error, simpan data ke database
    if (empty($errors)) {
        $nim = mysqli_real_escape_string($conn, $input['NIM']);
        $nama = mysqli_real_escape_string($conn, $input['nama']);
        $jurusan = mysqli_real_escape_string($conn, $input['jurusan']);
        $alamat = mysqli_real_escape_string($conn, $input['alamat']);
        $jenis_kelamin = mysqli_real_escape_string($conn, $input['kelamin']);
        $nomor_hp = mysqli_real_escape_string($conn, $input['hp']);
        $password = md5(mysqli_real_escape_string($conn, $input['password']));
        
        $sql = "INSERT INTO pendaftaran (
            nim_pendaftaran, 
            nama_pendaftaran, 
            jurusan_pendaftaran, 
            alamat_pendaftaran, 
            jenis_kelamin_pendaftaran, 
            nomor_handphone_pendaftaran,
            password_pendaftaran
        ) VALUES (
            '$nim',
            '$nama',
            '$jurusan',
            '$alamat',
            '$jenis_kelamin',
            '$nomor_hp',
            '$password'
        )";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Pendaftaran berhasil! Menunggu persetujuan admin.');
                  window.location.href='pemberitahuan_register.php?nim=" . urlencode($nim) . "';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

if (isset($_POST['batal'])) {
    header('location:login_warga.php');
}
?>


<!DOCTYPE html>
<html>

    <head>
        <title>Form Data User</title>
        <style>
        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 20px;
        }
        </style>
    </head>

    <body>
        <form action="register_warga.php" method="POST">
            <h2>Tambah User Baru</h2>

            <label for="NIM">NIM</label>
            <input type="text" id="NIM" name="NIM" value="<?= htmlspecialchars($input['NIM']) ?>">
            <span style="color: red;"><?= $errors['NIM'] ?? '' ?></span>

            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <span style="color: red;"><?= $errors['password'] ?? '' ?></span>

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($input['nama']) ?>">
            <span style="color: red;"><?= $errors['nama'] ?? '' ?></span>

            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat"><?= htmlspecialchars($input['alamat']) ?></textarea>
            <span style="color: red;"><?= $errors['alamat'] ?? '' ?></span>

            <label for="hp">HP</label>
            <input type="text" id="hp" name="hp" value="<?= htmlspecialchars($input['hp']) ?>">
            <span style="color: red;"><?= $errors['hp'] ?? '' ?></span>

            <label for="kelamin">Jenis Kelamin</label>
            <select id="kelamin" name="kelamin">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" <?= $input['kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $input['kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <span style="color: red;"><?= $errors['kelamin'] ?? '' ?></span>

            <label for="jurusan">Jurusan</label>
            <select id="jurusan" name="jurusan" class="form-select">
                <option value="">Pilih Jurusan</option>
                <option value="S1 Ilmu Hukum"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Ilmu Hukum' ? 'selected' : '' ?>>S1 Ilmu
                    Hukum</option>
                <option value="S1 Manajemen"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Manajemen' ? 'selected' : '' ?>>S1
                    Manajemen</option>
                <option value="S1 Akuntansi"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Akuntansi' ? 'selected' : '' ?>>S1
                    Akuntansi</option>
                <option value="S1 Ekonomi Pembangunan"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Ekonomi Pembangunan' ? 'selected' : '' ?>>
                    S1 Ekonomi Pembangunan</option>
                <option value="S1 Agroteknologi"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Agroteknologi' ? 'selected' : '' ?>>S1
                    Agroteknologi</option>
                <option value="S1 Agribisnis"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Agribisnis' ? 'selected' : '' ?>>S1
                    Agribisnis</option>
                <option value="S1 Teknologi Ilmu Pertanian"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Teknologi Ilmu Pertanian' ? 'selected' : '' ?>>
                    S1 Teknologi Ilmu Pertanian</option>
                <option value="S1 Ilmu Kelautan"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Ilmu Kelautan' ? 'selected' : '' ?>>S1 Ilmu
                    Kelautan</option>
                <option value="S1 Manajemen Sumberdaya Perairan"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Manajemen Sumberdaya Perairan' ? 'selected' : '' ?>>
                    S1 Manajemen Sumberdaya Perairan</option>
                <option value="S1 Teknik Informatika"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Teknik Informatika' ? 'selected' : '' ?>>S1
                    Teknik Informatika</option>
                <option value="S1 Teknik Industri"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Teknik Industri' ? 'selected' : '' ?>>S1
                    Teknik Industri</option>
                <option value="S1 Teknik Elektro"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Teknik Elektro' ? 'selected' : '' ?>>S1
                    Teknik Elektro</option>
                <option value="S1 Sistem Informasi"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Sistem Informasi' ? 'selected' : '' ?>>S1
                    Sistem Informasi</option>
                <option value="S1 Teknik Mekatronika"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Teknik Mekatronika' ? 'selected' : '' ?>>S1
                    Teknik Mekatronika</option>
                <option value="S1 Teknik Mesin"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Teknik Mesin' ? 'selected' : '' ?>>S1
                    Teknik Mesin</option>
                <option value="S1 Sosiologi"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Sosiologi' ? 'selected' : '' ?>>S1
                    Sosiologi</option>
                <option value="S1 Ilmu Komunikasi"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Ilmu Komunikasi' ? 'selected' : '' ?>>S1
                    Ilmu Komunikasi</option>
                <option value="S1 Sastra Inggris"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Sastra Inggris' ? 'selected' : '' ?>>S1
                    Sastra Inggris</option>
                <option value="S1 Psikologi"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Psikologi' ? 'selected' : '' ?>>S1
                    Psikologi</option>
                <option value="S1 Pendidikan Guru Sekolah Dasar"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Pendidikan Guru Sekolah Dasar' ? 'selected' : '' ?>>
                    S1 Pendidikan Guru Sekolah Dasar</option>
                <option value="S1 Pendidikan Anak Usia Dini"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Pendidikan Anak Usia Dini' ? 'selected' : '' ?>>
                    S1 Pendidikan Anak Usia Dini</option>
                <option value="S1 Pendidikan Ilmu Pengetahuan Alam"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Pendidikan Ilmu Pengetahuan Alam' ? 'selected' : '' ?>>
                    S1 Pendidikan Ilmu Pengetahuan Alam</option>
                <option value="S1 Pendidikan Informatika"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Pendidikan Informatika' ? 'selected' : '' ?>>
                    S1 Pendidikan Informatika</option>
                <option value="S1 Pendidikan Bahasa dan Sastra Indonesia"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Pendidikan Bahasa dan Sastra Indonesia' ? 'selected' : '' ?>>
                    S1 Pendidikan Bahasa dan Sastra Indonesia</option>
                <option value="S1 Hukum Bisnis Syariah"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Hukum Bisnis Syariah' ? 'selected' : '' ?>>
                    S1 Hukum Bisnis Syariah</option>
                <option value="S1 Ekonomi Syariah"
                    <?= isset($input['jurusan']) && $input['jurusan'] == 'S1 Ekonomi Syariah' ? 'selected' : '' ?>>S1
                    Ekonomi Syariah</option>
            </select>

            <span style="color: red;"><?= $errors['jurusan'] ?? '' ?></span>

            <button type="submit" name="tambah">Simpan</button>
            <button type="submit" name="batal">Batal</button>
        </form>

    </body>

</html>
