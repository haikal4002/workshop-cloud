<?php
session_start();

if (isset($_SESSION['pendaftaran']) && count($_SESSION['pendaftaran']) > 0) {
    echo "<p>Anda memiliki " . count($_SESSION['pendaftaran']) . " pendaftaran baru yang perlu disetujui.</p>";
} else {
    echo "<p>Tidak ada pendaftaran baru.</p>";
}
?>
