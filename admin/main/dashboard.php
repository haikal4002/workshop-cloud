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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
     <a class="bg-white p-6 rounded-lg shadow flex items-center space-x-4 hover:bg-gray-100" href="data.php">
      <i class="fas fa-users text-blue-600 text-2xl">
      </i>
      <div>
       <div class="text-gray-800 font-semibold">
        Data User
       </div>
       <div class="text-gray-500 text-sm">
        Manage user data
       </div>
      </div>
     </a>
     <a class="bg-white p-6 rounded-lg shadow flex items-center space-x-4 hover:bg-gray-100" href="ekstrakulikuler.php">
      <i class="fas fa-futbol text-orange-600 text-2xl">
      </i>
      <div>
       <div class="text-gray-800 font-semibold">
        Ekstrakulikuler
       </div>
       <div class="text-gray-500 text-sm">
        Manage extracurricular activities
       </div>
      </div>
     </a>
     <a class="bg-white p-6 rounded-lg shadow flex items-center space-x-4 hover:bg-gray-100" href="master_detail_kamar.php">
      <i class="fas fa-bed text-purple-600 text-2xl">
      </i>
      <div>
       <div class="text-gray-800 font-semibold">
        Kamar
       </div>
       <div class="text-gray-500 text-sm">
        Manage rooms
       </div>
      </div>
     </a>
     <a class="bg-white p-6 rounded-lg shadow flex items-center space-x-4 hover:bg-gray-100" href="./berita_admin.php">
      <i class="fas fa-newspaper text-grey-600 text-2xl">
      </i>
      <div>
       <div class="text-gray-800 font-semibold">
        Berita
       </div>
       <div class="text-gray-500 text-sm">
        Manage news
       </div>
      </div>
     </a>
     <a class="bg-white p-6 rounded-lg shadow flex items-center space-x-4 hover:bg-gray-100" href="./manage_fasilitas.php">
      <i class="fas fa-concierge-bell text-yellow-600 text-2xl">
      </i>
      <div>
       <div class="text-gray-800 font-semibold">
        Fasilitas
       </div>
       <div class="text-gray-500 text-sm">
        Manage facilities
       </div>
      </div>
     </a>
     <a class="bg-white p-6 rounded-lg shadow flex items-center space-x-4 hover:bg-gray-100" href="./profil_admin.php">
      <i class="fas fa-user text-red-600 text-2xl">
      </i>
      <div>
       <div class="text-gray-800 font-semibold">
        Profil
       </div>
       <div class="text-gray-500 text-sm">
        Manage profile
       </div>
      </div>
     </a>
     <a class="bg-white p-6 rounded-lg shadow flex items-center space-x-4 hover:bg-gray-100" href="kesehatan.php">
      <i class="fas fa-notes-medical text-green-600 text-2xl"></i>
      <div>
       <div class="text-gray-800 font-semibold">
        kesehatan
       </div>
       <div class="text-gray-500 text-sm">
        Manage health
       </div>
      </div>
     </a>
     <a class="bg-white p-6 rounded-lg shadow flex items-center space-x-4 hover:bg-gray-100" href="pendaftaran.php">
    <i class="fas fa-user-check text-blue-600 text-2xl"></i>
    <div>
        <div class="text-gray-800 font-semibold">
        Pendaftaran
        </div>
        <div class="text-gray-500 text-sm">
        Manage registration
        </div>
    </div>
    </a>

    </div>
<?php
    include "../template/script.php"
?>
