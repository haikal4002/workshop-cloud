<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti sesuai konfigurasi MySQL Anda
$password = "";
$database = "asrama";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data no_kamar dari tabel kamar
$kamar_result = $conn->query("SELECT no_kamar FROM kamar");
$kamar_options = [];
if ($kamar_result->num_rows > 0) {
    while ($row = $kamar_result->fetch_assoc()) {
        $kamar_options[] = $row['no_kamar'];
    }
}

// Ambil data nim_pengurus dari tabel pengurus
$pengurus_result = $conn->query("SELECT nim_pengurus FROM pengurus");
$pengurus_options = [];
if ($pengurus_result->num_rows > 0) {
    while ($row = $pengurus_result->fetch_assoc()) {
        $pengurus_options[] = $row['nim_pengurus'];
    }
}

// Inisialisasi variabel untuk notifikasi
$notification = "";

// Logika untuk memperbarui data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_warga'];
    $jurusan = $_POST['jurusan_warga'];
    $alamat = $_POST['alamat_warga'];
    $password = $_POST['password_warga'];
    $jenis_kelamin = $_POST['jenis_kelamin_warga'];
    $nomor_handphone = $_POST['nomor_handphone_warga'];
    $no_kamar = $_POST['no_kamar'];
    $nim_pengurus = $_POST['nim_pengurus'];

    // Query untuk memperbarui data
    $sql_update = "UPDATE warga_asrama SET 
        nama_warga='$nama', 
        jurusan_warga='$jurusan', 
        alamat_warga='$alamat', 
        password_warga='$password', 
        jenis_kelamin_warga='$jenis_kelamin', 
        nomor_handphone_warga='$nomor_handphone', 
        no_kamar='$no_kamar',
        nim_pengurus='$nim_pengurus'
        WHERE nim_warga='$nim'";

    if ($conn->query($sql_update) === TRUE) {
        $notification = "Data berhasil diperbarui!";
    } else {
        $notification = "Gagal memperbarui data: " . $conn->error;
    }
}

// Logika untuk menambah data baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_warga'];
    $jurusan = $_POST['jurusan_warga'];
    $alamat = $_POST['alamat_warga'];
    $password = $_POST['password_warga'];
    $jenis_kelamin = $_POST['jenis_kelamin_warga'];
    $nomor_handphone = $_POST['nomor_handphone_warga'];
    $no_kamar = $_POST['no_kamar'];
    $nim_pengurus = $_POST['nim_pengurus'];

    // Query untuk menambah data baru
    $sql_add = "INSERT INTO warga_asrama (nim_warga, nama_warga, jurusan_warga, alamat_warga, password_warga, jenis_kelamin_warga, nomor_handphone_warga, no_kamar, nim_pengurus)
        VALUES ('$nim', '$nama', '$jurusan', '$alamat', '$password', '$jenis_kelamin', '$nomor_handphone', '$no_kamar', '$nim_pengurus')";

    if ($conn->query($sql_add) === TRUE) {
        $notification = "Akun baru berhasil ditambahkan!";
    } else {
        $notification = "Gagal menambah data: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Link ke Font Awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #004080;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .container {
            width: 70%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            color: #004080;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            background-color: #004080;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #FFC107;
        }

        .form-action {
            display: flex;
            justify-content: space-between;
        }

        .form-action a {
            color: #004080;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .form-action a:hover {
            color: #FFC107;
        }

        .alert {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }

        footer {
            background-color: #004080;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .options {
            margin: 20px 0;
            text-align: center;
        }

        .options button {
            background-color: #004080;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px;
        }

        .options button:hover {
            background-color: #FFC107;
        }
    </style>
</head>
<body>
    <header>
        <h1>Pengaturan Akun Pengguna</h1>
    </header>

    <div class="container">
        <!-- Notifikasi -->
        <?php if ($notification): ?>
            <div class="alert"><?php echo $notification; ?></div>
        <?php endif; ?>

        <!-- Pilihan untuk memperbarui data atau menambah data -->
        <div class="options">
            <button id="updateDataBtn">Perbarui Data Diri</button>
            <button id="addDataBtn">Tambah Akun Baru</button>
        </div>

        <!-- Form untuk memperbarui data diri -->
        <section id="updateDataSection" style="display:none;">
            <div class="section-title">Perbarui Data Diri</div>
            <form action="" method="POST">
                <input type="hidden" name="update" value="1">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>
                </div>
                <div class="form-group">
                    <label for="nama_warga">Nama Lengkap</label>
                    <input type="text" id="nama_warga" name="nama_warga" placeholder="Nama lengkap" required>
                </div>
                <div class="form-group">
                    <label for="jurusan_warga">Jurusan</label>
                    <input type="text" id="jurusan_warga" name="jurusan_warga" placeholder="Jurusan" required>
                </div>
                <div class="form-group">
                    <label for="alamat_warga">Alamat</label>
                    <input type="text" id="alamat_warga" name="alamat_warga" placeholder="Alamat" required>
                </div>
                <div class="form-group">
                    <label for="password_warga">Password</label>
                    <input type="password" id="password_warga" name="password_warga" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin_warga">Jenis Kelamin</label>
                    <select name="jenis_kelamin_warga" id="jenis_kelamin_warga" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nomor_handphone_warga">Nomor Handphone</label>
                    <input type="text" id="nomor_handphone_warga" name="nomor_handphone_warga" placeholder="Nomor Handphone" required>
                </div>
                <div class="form-group">
                    <label for="no_kamar">No Kamar</label>
                    <select name="no_kamar" id="no_kamar" required>
                        <?php foreach ($kamar_options as $no_kamar): ?>
                            <option value="<?php echo $no_kamar; ?>"><?php echo $no_kamar; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nim_pengurus">NIM Pengurus</label>
                    <select name="nim_pengurus" id="nim_pengurus" required>
                        <?php foreach ($pengurus_options as $nim_pengurus): ?>
                            <option value="<?php echo $nim_pengurus; ?>"><?php echo $nim_pengurus; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn">Perbarui Data</button>
            </form>
        </section>

        <!-- Form untuk menambah akun baru -->
        <section id="addDataSection" style="display:none;">
            <div class="section-title">Tambah Akun Baru</div>
            <form action="" method="POST">
                <input type="hidden" name="add" value="1">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>
                </div>
                <div class="form-group">
                    <label for="nama_warga">Nama Lengkap</label>
                    <input type="text" id="nama_warga" name="nama_warga" placeholder="Nama lengkap" required>
                </div>
                <div class="form-group">
                    <label for="jurusan_warga">Jurusan</label>
                    <input type="text" id="jurusan_warga" name="jurusan_warga" placeholder="Jurusan" required>
                </div>
                <div class="form-group">
                    <label for="alamat_warga">Alamat</label>
                    <input type="text" id="alamat_warga" name="alamat_warga" placeholder="Alamat" required>
                </div>
                <div class="form-group">
                    <label for="password_warga">Password</label>
                    <input type="password" id="password_warga" name="password_warga" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin_warga">Jenis Kelamin</label>
                    <select name="jenis_kelamin_warga" id="jenis_kelamin_warga" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nomor_handphone_warga">Nomor Handphone</label>
                    <input type="text" id="nomor_handphone_warga" name="nomor_handphone_warga" placeholder="Nomor Handphone" required>
                </div>
                <div class="form-group">
                    <label for="no_kamar">No Kamar</label>
                    <select name="no_kamar" id="no_kamar" required>
                        <?php foreach ($kamar_options as $no_kamar): ?>
                            <option value="<?php echo $no_kamar; ?>"><?php echo $no_kamar; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nim_pengurus">NIM Pengurus</label>
                    <select name="nim_pengurus" id="nim_pengurus" required>
                        <?php foreach ($pengurus_options as $nim_pengurus): ?>
                            <option value="<?php echo $nim_pengurus; ?>"><?php echo $nim_pengurus; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn">Tambah Akun</button>
            </form>
        </section>
    </div>

    <footer>
        &copy; 2024 Asrama Mahasiswa
    </footer>

    <script>
        // Menambahkan event listener untuk tombol pilih
        document.getElementById('updateDataBtn').addEventListener('click', function() {
            document.getElementById('updateDataSection').style.display = 'block';
            document.getElementById('addDataSection').style.display = 'none';
        });

        document.getElementById('addDataBtn').addEventListener('click', function() {
            document.getElementById('addDataSection').style.display = 'block';
            document.getElementById('updateDataSection').style.display = 'none';
        });
    </script>
</body>
</html>
<?php
    include "assets/footer.php";
?>
