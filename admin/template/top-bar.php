<div class="flex justify-between items-center mb-6 bg-white p-4 rounded-lg shadow w-full">
    <div class="flex items-center space-x-4">
        <button class="bg-gray-200 text-gray-600 rounded-full p-2" id="themeSwitcher">
            <i class="fas fa-adjust"></i>
        </button>
    </div>
    <div class="flex items-center space-x-4 relative">
        <!-- Ikon bel dengan jumlah pendaftar baru -->
        <i class="fas fa-bell text-gray-500 relative cursor-pointer text-3xl" id="notifBell">
            <?php
            $notif_count_query = "SELECT COUNT(*) as total FROM pendaftaran";
            $notif_count_result = mysqli_query($conn, $notif_count_query);
            $notif_count = mysqli_fetch_assoc($notif_count_result)['total'];
            if ($notif_count > 0):
            ?>
                <span class="absolute top-0 right-0 rounded-full bg-red-500 text-white text-xs px-2 py-1 min-w-[20px] text-center">
                    <?php echo $notif_count; ?>
                </span>
            <?php endif; ?>
        </i>
        <!-- <i class="fas fa-comment-dots text-gray-500"></i> -->
        <div class="flex items-center space-x-2">
        <i class="fas fa-user-circle rounded-full text-gray-500 w-10 h-10" style="font-size: 40px;"></i>
            <div>
                <div class="text-gray-800 font-semibold">admin1</div>
                <div class="text-gray-500 text-sm">Admin</div>
            </div>
            <i class="fas fa-chevron-down text-gray-500 cursor-pointer" id="profileMenuButton"></i>
            <div class="absolute right-0 mt-12 w-48 bg-white rounded-lg shadow-lg py-2 hidden" id="profileMenu">
                <a class="block px-4 py-2 text-gray-800 hover:bg-gray-100" href="../../login/logout_admin.php">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Notifikasi -->
<div id="notificationModal" class="fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
        <h2 class="text-lg font-semibold mb-4">Pemberitahuan</h2>
        <div class="max-h-60 overflow-y-auto">
            <?php
            $notif_query = "SELECT * FROM pendaftaran ORDER BY nim_pendaftaran DESC LIMIT 5";
            $notif_result = mysqli_query($conn, $notif_query);
            $notif_count = mysqli_num_rows($notif_result);
            if ($notif_count > 0):
            ?>
                <ul class="space-y-2">
                <?php while ($notif = mysqli_fetch_assoc($notif_result)): ?>
                    <li class="p-2 hover:bg-gray-100 rounded">
                        <strong><?= htmlspecialchars($notif['nama_pendaftaran']) ?></strong>
                        <br>
                        <span class="text-sm text-gray-600">NIM: <?= htmlspecialchars($notif['nim_pendaftaran']) ?></span>
                    </li>
                <?php endwhile; ?>
                </ul>
                <p class="mt-4 text-sm text-gray-600">Total pendaftar baru: <?php echo $notif_count; ?></p>
            <?php else: ?>
                <p class="text-gray-600">Tidak ada pendaftar baru.</p>
            <?php endif; ?>
        </div>
        <button class="mt-4 bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" id="closeModal">Tutup</button>
    </div>
</div>

<style>
#notifBell {
    font-size: 2rem;
}

#notifBell span {
    font-size: 0.75rem;
    padding: 0.1rem 0.4rem;
    min-width: 20px;
    height: 20px;
    line-height: 20px;
    text-align: center;
}
</style>

<script>
document.getElementById('notifBell').addEventListener('click', function() {
    document.getElementById('notificationModal').classList.remove('hidden');
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('notificationModal').classList.add('hidden');
});

// Menutup modal saat mengklik area di luar modal
document.getElementById('notificationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.add('hidden');
    }
});
</script>
