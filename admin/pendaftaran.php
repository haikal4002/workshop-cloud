<?php
session_start();

if (isset($_SESSION['pendaftaran']) && count($_SESSION['pendaftaran']) > 0) {
    echo "<h3>Daftar Pendaftaran Baru:</h3>";
    echo "<ul>";
    foreach ($_SESSION['pendaftaran'] as $index => $data) {
        echo "<li>";
        echo "NIM: " . htmlspecialchars($data['NIM']) . " - Nama: " . htmlspecialchars($data['nama']);
        echo " <form method='POST' action=''>
                  <input type='hidden' name='index' value='{$index}' />
                  <button type='submit' name='setujui'>Setujui</button>
              </form>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Tidak ada pendaftaran baru.</p>";
}
?>
