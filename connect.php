<?php
    $conn=mysqli_connect('localhost','root','','asrama');
    if (!$conn){
        die('tidak terkoneksi'.mysqli_connect_error());
    }
?>