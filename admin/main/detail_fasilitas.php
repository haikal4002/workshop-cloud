<?php
    include "../template/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
?>
<?php
    include "../template/sidebar.php"
?>

<?php
    include "../template/top-bar.php"
?>

<?php
    // Mengambil ID fasilitas dari URL dan pastikan id tersedia dan valid
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_fasilitas = $_GET['id'];
        

        // Mengambil data fasilitas berdasarkan ID
        $sql = "SELECT * FROM fasilitas WHERE id_fasilitas = $id_fasilitas";
        $result = $conn->query($sql);

        // Pastikan data ditemukan
        if ($result->num_rows > 0) {
            $fasilitas_item = $result->fetch_assoc();
        } else {
            echo "<p>Fasilitas tidak ditemukan.</p>";
            exit;
        }

        $conn->close();
    } else {
        echo "<p>ID fasilitas tidak valid.</p>";
        exit;
    }
?>
    <style>
        /* Reset dan pengaturan dasar */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #004080;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-size: 24px;
            margin: 0;
        }

        h1 {
            font-size: 28px;
            color: #004080;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
            text-align: center;
            margin: 10px 0;
        }

        footer {
            background-color: #004080;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container p {
            margin: 10px 0;
        }

        footer {
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 22px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }

            footer {
                font-size: 12px;
            }
        }
    </style>

    <header>
        <h1>Detail Fasilitas</h1>
    </header>

    <div class="container">
        <h1><?= $fasilitas_item['nama_fasilitas'] ?></h1>
        <p><strong>Aturan Penggunaan:</strong></p>
        <p><?= $fasilitas_item['aturan_penggunaan'] ?></p>
        <p><strong>Jumlah Fasilitas:</strong> <?= $fasilitas_item['jumlah_fasilitas'] ?></p>
    </div>


