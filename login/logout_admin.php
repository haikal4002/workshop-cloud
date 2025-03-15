<?php
    session_start();
    unset($_SESSION['nama_admin']);
    // unset($_SESSION['role']);
    unset($_SESSION['logged_in']);
    header('Location: login_warga.php');
?>