<?php
    require "../connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        .input-container {
            position: relative;
            margin-bottom: 30px;
        }
        .input-container input {
            width: 100%;
            padding: 10px 10px 10px 30px;
            border: none;
            border-bottom: 2px solid #ddd;
            outline: none;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .input-container input:focus {
            border-bottom: 2px solid #007bff;
        }
        .input-container input::placeholder {
            color: transparent; /* Menyembunyikan placeholder saat fokus */
        }
        .input-container label {
            position: absolute;
            top: 10px;
            left: 30px;
            font-size: 14px;
            color: #aaa;
            transition: all 0.3s ease;
            pointer-events: none; /* Agar label tidak mengganggu klik */
        }
        .input-container input:focus + label,
        .input-container input:not(:placeholder-shown) + label {
            top: -10px;
            font-size: 12px;
            color: #007bff;
        }
        .input-container i {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 16px;
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
            margin-bottom: 10px;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Asrama</h2>
        <form action="proses_login_warga.php" method="POST">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" id="username" name="username" placeholder=" " >
                <label for="username">Masukkan Username</label>
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder=" " >
                <label for="password">Masukkan Password</label>
            </div>
            <button type="submit" name="login">Login</button>
            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>
</html>
