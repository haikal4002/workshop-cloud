<?php
    session_start();
    include "connect.php";
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password=md5($_POST['password']);
        $cek = "SELECT `nama`,`password` ,`level`FROM users WHERE users.username='$username' AND users.`password`='$password'";
        $result = mysqli_query($conn, $cek);
        if (mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username']= $row['username'];
            $_SESSION['nama']= $row['nama'];
            $_SESSION['level']= $row['level'];
            $_SESSION['logged_in']= true;
            echo '<script>window.location.href= "index.php"</script>';
        }else{
            echo "<script>alert('username atau password salah')</script>";
        }
    }
    // if (isset($_POST['register'])) {
    //    header('location:form.php');
    // }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .login-container label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .login-container button:hover {
            background-color: #009bff;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <button type="submit" name="login">Login</button>
            <button type="submit" name="register">register</button>
        </form>
    </div>
</body>
</html>
