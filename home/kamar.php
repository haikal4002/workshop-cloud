<?php require 'assets/header.php'; ?>
<?php
include '../connect.php';
// include 'session_check.php';
?>
<!DOCTYPE html>
<html lang="en">

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

        <main>
            <div class="m-0 mb-2 border border-2 mx-5 my-5 shadow-lg">
                <div class="m-0 p-1 shadow-lg" style="background-color: #37AFE1; color: white; font-family: Lucida Sans;">
                    <h2 class="text-center" id="titlekamar"></h2>
                </div>
            <div class="d-flex">
            <div class="container mt-5">
                <div class="d-flex justify-content-end mb-2">
                    <button class="rounded shadow-lg" onclick="window.location.href='search_data_kamar.php'" style="width: 100px; height: 40px; background-color: #2192FF; border: none; color: white;">Search</button>
                </div>
                    <div class="row">
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM kamar, gedung WHERE gedung.id_gedung = kamar.id_gedung");
                        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        ?>

                        <?php if (mysqli_num_rows($query) > 0): ?>
                            <?php foreach ($result as $data): ?>
                                <?php  
                                if ($data['status_kamar'] == 'Tersedia') {
                                    $statusColor = '#219B9D';
                                } elseif ($data['status_kamar'] == 'Kosong') {
                                    $statusColor = '#1F509A';
                                } else {
                                    $statusColor = '#D91656';
                                }

                                $no_kamar = $data['no_kamar'];
                                $sql_penghuni = "SELECT COUNT(*) AS jumlah_penghuni FROM warga_asrama WHERE no_kamar = '$no_kamar'";
                                $result_penghuni = mysqli_query($conn, $sql_penghuni);
                                $penghuni = mysqli_fetch_assoc($result_penghuni);
                                $jumlah_penghuni = $penghuni['jumlah_penghuni'];

                                $kapasitas_kamar = 6;
                                $tersedia = $kapasitas_kamar - $jumlah_penghuni;
                            ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-lg outer-card kamar" style="background-color: #E2F4FD;">
                                <h4 class="card-header" style="width: 100%; text-align: center; background-color: #084B83; color: white;">Kamar</h4>
                                <h5 class="card-title p-2" style="width: 100%; text-align: center; color: white; background-color: #17689A;"><?= $no_kamar ?></h5>
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <p class="card-text fw-bold">Gedung: <?= $data['nama_gedung'] ?>  </p>
                                        <p class="card-text fw-bold p-1" style="color: black">Status : <span class="p-1" style="background-color: <?= $statusColor ?>; color: white;"> <?= $data['status_kamar']  ?></span></p>
                                        <p class="card-text fw-bold">Jumlah Penghuni: <?= $jumlah_penghuni ?> / <?= $kapasitas_kamar ?></p>
                                        <p class="card-text fw-bold">Kamar Tersedia: <?= $tersedia ?></p>
                                        <form action="detail_kamar.php" method="get">
                                            <input type="hidden" name="no_kamar" value="<?= $no_kamar ?>">
                                            <button type="submit" class="btn btn-primary">Lihat Detail Kamar</button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        
                        <?php else: echo "0 results";?>
                        
                        <?php endif; ?>
                    </div>
                </div>
                <div class="gotop" id="gotop">
                    <a href="#home" class="bg-secondary p-2 shadow-lg">
                        <img src="./assets/img/arrow-up.png" alt="Go to top" width="30">
                    </a>
                </div>

            </div>
            </div>
        </main>

        <script>
            var text = "Berikut Daftar Kamar di Asrama"
            var output = document.getElementById("titlekamar")

            var i = 0
            function typeWriter(){
                if (i < text.length){
                    output.textContent += text.charAt(i);
                    i++
                    setTimeout(typeWriter, 50);
                }
            }

            typeWriter()


            document.addEventListener('scroll', function () {
                const scroll = window.scrollY || document.documentElement.scrollTop;
                    const gotop = document.getElementById('gotop');
                    
                    if (scroll > 100) {
                        gotop.style.display = 'block';
                    } else {
                        gotop.style.display = 'none';
                    }
                });

            document.getElementById('gotop').addEventListener('click', function (event) {
                event.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth',
                });
            });
        </script>
    </body>
                            
<?php
    include "assets/footer.php";
?>
</html>