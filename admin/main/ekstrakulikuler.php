<?php
    include "../template/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . '/asrama/connect.php';
?>
<?php
    include "../template/sidebar.php";
?>
<?php
    include "../template/top-bar.php";
?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <a href="bahasa_arab.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
            <i class="fas fa-language text-green-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Bahasa Arab</div>
                <div class="text-gray-500 text-sm">Manajemen tabel Bahasa Arab</div>
            </div>
        </div>
    </a>
    <a href="bahasa_inggris.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
            <i class="fas fa-language text-blue-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Bahasa Inggris</div>
                <div class="text-gray-500 text-sm">Manajemen tabel Bahasa Inggris</div>
            </div>
        </div>
    </a>
    <a href="arduino.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
            <i class="fas fa-microchip text-red-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Arduino</div>
                <div class="text-gray-500 text-sm">Manajemen tabel Arduino</div>
            </div>
        </div>
    </a>
    <a href="sholawat.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
            <i class="fas fa-music text-purple-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Sholawat</div>
                <div class="text-gray-500 text-sm">Manajemen tabel Sholawat</div>
            </div>
        </div>
    </a>
    <a href="qiroah.php" class="bg-white p-6 rounded-lg shadow hover:bg-gray-100">
        <div class="flex items-center space-x-4">
            <i class="fas fa-book text-yellow-600 text-2xl"></i>
            <div>
                <div class="text-gray-800 font-semibold">Qiroah Alquran</div>
                <div class="text-gray-500 text-sm">Manajemen tabel Qiroah Alquran</div>
            </div>
        </div>
    </a>
</div>
<?php
    include "../template/script.php";
?>

