<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
    include "../template/head.php";
?>
<?php
    include "../template/sidebar.php";
?>
<?php
    include "../template/top-bar.php";
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <a href="index_pasien.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
        <i class="fas fa-hospital-user text-blue-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Data Pasien</div>
            </div>
        </div>
    </a>
    <a href="riwayat_pasien.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
        <i class="fas fa-hospital-user text-yellow-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Riwayat Pasien</div>
            </div>
        </div>
    </a>
    <a href="index_obat.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
            <i class="fas fa-capsules text-red-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Data Obat</div>
            </div>
        </div>
    </a>
    <a href="pasien.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
            <i class="fas fa-bed text-greend-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Tambah Data Pasien</div>
            </div>
        </div>
    </a>
    <a href="obat.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
            <i class="fas fa-pills text-purple-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Tambah Data Obat</div>
            </div>
        </div>
    </a>
</div>
<?php
    include "../template/script.php";
?>

