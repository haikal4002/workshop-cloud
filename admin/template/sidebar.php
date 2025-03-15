<!-- Sidebar -->
<div class="bg-gray-900 text-white w-64 min-h-screen">
      <div class="p-6">
        <div class="flex items-center space-x-2">
          <div class="bg-blue-600 p-2 rounded">
            <i class="fas fa-chart-bar text-white"></i>
          </div>
          <span class="text-xl font-semibold">Asrama</span>
        </div>
      </div>
      <nav class="mt-6">
        <div class="px-6 py-2 text-gray-400">MENU</div>
        <a class="flex items-center px-6 py-2 text-gray-200" href="../main/dashboard.php">
          <i class="fas fa-tachometer-alt mr-3"></i>
          <span>Dashboard</span>
        </a>
        <a class="flex items-center px-6 py-2 text-gray-400" href="data.php">
          <i class="fas fa-users mr-3"></i>
          <span>Data User</span>
        </a>
        <div class="px-6 py-2 text-gray-200 bg-gray-800 cursor-pointer" id="ekstrakulikulerMenuButton">
          <div class="flex items-center justify-between" href='../main/ekstrakulikuler.php'>
            <div class="flex items-center">
              <i class="fas fa-futbol mr-3"></i>
              <span>Ekstrakulikuler</span>
            </div>
            <i class="fas fa-chevron-down"></i>
          </div>
        </div>
        <div class="hidden" id="ekstrakulikulerMenu">
          <a class="flex items-center px-6 py-2 text-gray-400" href="bahasa_arab.php">
            <span>Bahasa Arab</span>
          </a>
          <a class="flex items-center px-6 py-2 text-gray-400" href="bahasa_inggris.php">
            <span>Bahasa Inggris</span>
          </a>
          <a class="flex items-center px-6 py-2 text-gray-400" href="arduino.php">
            <span>Arduino</span>
          </a>
          <a class="flex items-center px-6 py-2 text-gray-400" href="sholawat.php">
            <span>Sholawat</span>
          </a>
          <a class="flex items-center px-6 py-2 text-gray-400" href="qiroah.php">
            <span>Qiroah Alquran</span>
          </a>
        </div>
        <a class="flex items-center px-6 py-2 text-gray-400" href="../main/master_detail_kamar.php">
          <i class="fas fa-bed mr-3"></i>
          <span>Kamar</span>
        </a>
        <a class="flex items-center px-6 py-2 text-gray-400" href="../main/berita_admin.php">
          <i class="fas fa-newspaper mr-3"></i>
          <span>Berita</span>
        </a>
        <a class="flex items-center px-6 py-2 text-gray-400" href="../main/manage_fasilitas.php">
          <i class="fas fa-concierge-bell mr-3"></i>
          <span>Fasilitas</span>
        </a>
        <a class="flex items-center px-6 py-2 text-gray-400" href="../main/profil_admin.php">
          <i class="fas fa-user mr-3"></i>
          <span>Profil</span>
        </a>
        <a class="flex items-center px-6 py-2 text-gray-400" href="kesehatan.php">
          <i class="fas fa-notes-medical mr-3"></i>
          <span>kesehatan</span>
        </a>
        <a class="flex items-center px-6 py-2 text-gray-400" href="pendaftaran.php">
          <i class="fas fa-user-plus mr-3"></i>
          <span>pendaftaran</span>
        </a>
      </nav>
    </div>
    <div class="flex-1 p-6">