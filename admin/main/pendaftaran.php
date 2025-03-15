<?php
    ob_start();
    include "../template/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
    include "../template/sidebar.php";
    include "../template/top-bar.php";

    // Cek jika ada data pencarian
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $searchBy = isset($_POST['search_by']) ? $_POST['search_by'] : 'nama';

    // Query dasar untuk mengambil data dari tabel pendaftaran
    $base_query = "SELECT * FROM pendaftaran";
    
    // Jika ada pencarian, tambahkan kondisi WHERE
    if ($search) {
        if ($searchBy == 'nama') {
            $base_query .= " WHERE nama_pendaftaran LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
        } elseif ($searchBy == 'nim') {
            $base_query .= " WHERE nim_pendaftaran LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
        }
    }

    $result = mysqli_query($conn, $base_query);
    $pendaftaran_data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $pendaftaran_data[] = $row;
    }

    // Proses untuk menyetujui pendaftaran
    if (isset($_POST['setujui']) && isset($_POST['index'])) {
        $success = true; // Flag untuk mengecek semua proses berhasil
        
        foreach ($_POST['index'] as $nim_pendaftaran) {
            $pengurus = isset($_POST['pengurus'][$nim_pendaftaran]) ? $_POST['pengurus'][$nim_pendaftaran] : null;
            $no_kamar = isset($_POST['no_kamar'][$nim_pendaftaran]) ? $_POST['no_kamar'][$nim_pendaftaran] : null;

            if (!$pengurus || !$no_kamar) {
                echo "<script>alert('Mohon pilih pengurus dan nomor kamar untuk NIM: $nim_pendaftaran');</script>";
                $success = false;
                continue;
            }

            // Proses sisanya sama seperti sebelumnya
            $query_pendaftar = "SELECT * FROM pendaftaran WHERE nim_pendaftaran = '" . mysqli_real_escape_string($conn, $nim_pendaftaran) . "'";
            $result_pendaftar = mysqli_query($conn, $query_pendaftar);
            $data_pendaftar = mysqli_fetch_assoc($result_pendaftar);

            if ($data_pendaftar) {
                // Begin transaction
                mysqli_begin_transaction($conn);
                try {
                    // Insert ke tabel warga_asrama
                    $sql = "INSERT INTO warga_asrama (
                        nim_warga, 
                        nama_warga, 
                        jurusan_warga, 
                        alamat_warga, 
                        password_warga, 
                        jenis_kelamin_warga, 
                        nomor_handphone_warga, 
                        no_kamar, 
                        nim_pengurus
                    ) VALUES (
                        '{$data_pendaftar['nim_pendaftaran']}',
                        '{$data_pendaftar['nama_pendaftaran']}',
                        '{$data_pendaftar['jurusan_pendaftaran']}',
                        '{$data_pendaftar['alamat_pendaftaran']}',
                        '{$data_pendaftar['password_pendaftaran']}',
                        '{$data_pendaftar['jenis_kelamin_pendaftaran']}',
                        '{$data_pendaftar['nomor_handphone_pendaftaran']}',
                        '$no_kamar',
                        '$pengurus'
                    )";

                    $query = mysqli_query($conn, $sql);

                    if ($query == true) {
                        // Hapus data dari tabel pendaftaran
                        mysqli_query($conn, "DELETE FROM pendaftaran WHERE nim_pendaftaran = '$nim_pendaftaran'");
                        // Update status kamar
                        mysqli_query($conn, "UPDATE kamar SET status_kamar = 'Tidak Tersedia' WHERE no_kamar = '$no_kamar'");
                        mysqli_commit($conn);
                    } else {
                        throw new Exception(mysqli_error($conn));
                    }
                } catch (Exception $e) {
                    mysqli_rollback($conn);
                    echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
                    $success = false;
                }
            }
        }
        
        if ($success) {
            echo "<script>
                alert('Pendaftaran berhasil disetujui.');
                window.location.href = window.location.href;
            </script>";
        }
    }

    // Proses penghapusan data pendaftaran yang dipilih
    if (isset($_POST['hapus']) && isset($_POST['index'])) {
        $success = true;
        foreach ($_POST['index'] as $nim_pendaftaran) {
            $nim_pendaftaran = mysqli_real_escape_string($conn, $nim_pendaftaran);
            if (!mysqli_query($conn, "DELETE FROM pendaftaran WHERE nim_pendaftaran = '$nim_pendaftaran'")) {
                $success = false;
            }
        }
        
        if ($success) {
            echo "<script>
                alert('Data berhasil dihapus.');
                window.location.href = window.location.href;
            </script>";
        } else {
            echo "<script>alert('Gagal menghapus beberapa data.');</script>";
        }
    }

    // Menghapus semua data pendaftaran
    if (isset($_POST['hapus_semua'])) {
        if (mysqli_query($conn, "DELETE FROM pendaftaran")) {
            echo "<script>
                alert('Semua data pendaftaran telah dihapus.');
                window.location.href = window.location.href;
            </script>";
        } else {
            echo "<script>alert('Gagal menghapus semua data.');</script>";
        }
    }
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran</h6>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <form method="POST" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?= htmlspecialchars($search) ?>">
                            <select name="search_by" class="form-control">
                                <option value="nama" <?= $searchBy == 'nama' ? 'selected' : '' ?>>Nama</option>
                                <option value="nim" <?= $searchBy == 'nim' ? 'selected' : '' ?>>NIM</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form method="POST">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="check-all"></th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Pengurus</th>
                                <th>No Kamar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pendaftaran_data)): ?>
                                <?php foreach ($pendaftaran_data as $data): ?>
                                    <tr>
                                        <td><input type="checkbox" name="index[]" value="<?= htmlspecialchars($data['nim_pendaftaran']) ?>"></td>
                                        <td><?= htmlspecialchars($data['nim_pendaftaran']) ?></td>
                                        <td><?= htmlspecialchars($data['nama_pendaftaran']) ?></td>
                                        <td><?= htmlspecialchars($data['jurusan_pendaftaran']) ?></td>
                                        <td><?= htmlspecialchars($data['alamat_pendaftaran']) ?></td>
                                        <td><?= htmlspecialchars($data['jenis_kelamin_pendaftaran']) ?></td>
                                        <td><?= htmlspecialchars($data['nomor_handphone_pendaftaran']) ?></td>
                                        <td>
                                            <select name="pengurus[<?= htmlspecialchars($data['nim_pendaftaran']) ?>]" class="form-control">
                                                <option value="">Pilih Pengurus</option>
                                                <?php
                                                $sql_pengurus = "SELECT nim_pengurus, nama_pengurus FROM pengurus";
                                                $result_pengurus = mysqli_query($conn, $sql_pengurus);
                                                while ($row = mysqli_fetch_assoc($result_pengurus)) {
                                                    echo "<option value='" . htmlspecialchars($row['nim_pengurus']) . "'>" . 
                                                         htmlspecialchars($row['nama_pengurus']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="no_kamar[<?= htmlspecialchars($data['nim_pendaftaran']) ?>]" class="form-control">
                                                <option value="">Pilih Kamar</option>
                                                <?php
                                                $sql_kamar = "SELECT no_kamar FROM kamar WHERE status_kamar = 'Tersedia'";
                                                $result_kamar = mysqli_query($conn, $sql_kamar);
                                                while ($row = mysqli_fetch_assoc($result_kamar)) {
                                                    echo "<option value='" . htmlspecialchars($row['no_kamar']) . "'>" . 
                                                         htmlspecialchars($row['no_kamar']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data pendaftaran</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <button type="submit" name="setujui" class="btn btn-success">Setujui Yang Dipilih</button>
                    <button type="submit" name="hapus" class="btn btn-danger">Hapus Yang Dipilih</button>
                    <button type="submit" name="hapus_semua" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus semua data?')">Hapus Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Script untuk checkbox "pilih semua"
    document.getElementById('check-all').onclick = function() {
        var checkboxes = document.getElementsByName('index[]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
</script>
<?php
    include "../template/script.php"
?>
