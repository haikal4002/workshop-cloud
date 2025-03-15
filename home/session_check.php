<?php
    session_start();
    if (!isset($_SESSION['logged_in']) OR $_SESSION['logged_in'] == false) {
        header("Location: ../login/login_warga.php");
        exit();
    }
?>