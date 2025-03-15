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

    $query = mysqli_query($conn, "SELECT * FROM warga_asrama JOIN pengurus ON warga_asrama.nim_pengurus = pengurus.nim_pengurus ORDER BY no_kamar ASC");
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    
    $groupdata = [];
    foreach($result as $value){
        $groupdata[$value["no_kamar"]][]= $value;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga Asrama</title>

    <style>
        table {
            margin-bottom: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center h2">Pengelolaan Data Kamar</h2>

    <?php foreach ($groupdata as $key => $value): ?>
        <div class="card">
            <h4 class="card-header bg-info text-light">Kamar: <?= $key; ?></h4>
            <div class="p-3" style="overflow-x: auto;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomor Handphone</th>
                            <th>Nama Pengurus</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($value as $warga_asrama): ?>
                            <tr>
                                <td><?= $warga_asrama["nim_warga"] ?></td>
                                <td><?= $warga_asrama["nama_warga"] ?></td>
                                <td><?= $warga_asrama["jurusan_warga"] ?></td>
                                <td><?= $warga_asrama["alamat_warga"] ?></td>
                                <td><?= $warga_asrama["jenis_kelamin_warga"] ?></td>
                                <td><?= $warga_asrama["nomor_handphone_warga"] ?></td>
                                <td><?= $warga_asrama["nama_pengurus"] ?></td>
                                <td class="d-flex gap-2">
                                    <button type="button" onclick="window.location.href='edit_data_kamar.php?kamar=<?= $key; ?>&nim=<?= $warga_asrama['nim_warga'] ?>'" class="btn btn-warning shadow-lg rounded">Edit</button>
                                    <button type="button" onclick="erase(<?= $key ?>, <?= $warga_asrama['nim_warga'] ?>)" class="btn btn-danger shadow-lg rounded">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
</div>

<script>
    function erase(data1, data2){
        var konfirmasi = confirm("Apakah yakin menghapus data ini?");
        if (konfirmasi){
            window.location.href="hapusdata.php?kamar" + data1 + "&"+ "nim=" + data2;
        }
        else{
            window.location.href="master_detail_kamar.php";
        }
    }
</script>
</body>
</html>
<?php
    include "../template/script.php"
?>