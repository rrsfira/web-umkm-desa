<?php

@include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'user already exist!';
    } else {
        $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
        mysqli_query($conn, $insert);
        header('location:login.php');
    }
};


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <!-- Site Metas -->
    <link rel="shortcut icon" href="img/sidoarjo.png" type="">
    <!-- tittle -->
    <title> UMKM | Website Desa Pabean Sidoarjo </title>
    <!-- icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style-login.css" rel="stylesheet" />
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
    <!-- top navbar-->
    <div style="position: fixed; top: 0; left: 0; padding: 10px; font-size: 14px;">
        <a href="../index.php" style="text-decoration: none; color: black;">
            <img src="img/back.png" alt="Logo" style="height: 15px; margin-left: 30px; margin-bottom: 5px;">
            KEMBALI KE HALAMAN AWAL
        </a>
    </div><br>
    <div class="top-navbar" id="top">
        <img src="img/favicon.png" alt="Logo" style="height:40px; margin-left: 30px;">
        <a class="navbar-brand" id="logo"><span id="span1">UMKM</span> Desa Pabean</a>
    </div>
    <!-- top navbar -->

    <!--regis-->
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form action="" method="post">
                <h1>Buat Akun</h1>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    };
                };
                ?>
                <input type="text" name="name" required placeholder="Nama Pengguna">
                <input type="email" name="email" required placeholder="Email">
                <input type="password" name="password" required placeholder="Kata Sandi">
                <select name="user_type" id="user_type" disabled>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                    <option value="seller">penjual</option>
                </select>
                <!-- Elemen hidden input untuk mengirimkan nilai user_type -->
                <input type="hidden" name="user_type" value="user">
                <input type="submit" name="submit" value="Daftar" class="form-btn">
                <p>Sudah Punya Akun? <a href="login.php">Masuk Sekarang</a></p>
            </form>
        </div>
        <div class="form-container sign-up">
            <form action="" method="post">
                <h1>Buat Akun</h1>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    };
                };
                ?>
                <input type="text" name="name" required placeholder="Nama Pengguna">
                <input type="email" name="email" required placeholder="Email">
                <input type="password" name="password" required placeholder="Kata Sandi">
                <select name="user_type">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                    <option value="seller">penjual</option>
                </select>
                <input type="submit" name="submit" value="Daftar" class="form-btn">
                <p>Sudah Punya Akun? <a href="login.php">Masuk Sekarang</a></p>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Selamat Datang!</h1>
                    <p>Masukkan detail pribadi Anda untuk menggunakan semua fitur situs</p>
                    <button class="hidden" id="login">Daftar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Selamat Datang!</h1>
                    <p>Masukkan detail pribadi Anda untuk menggunakan semua fitur situs</p>
                    <button class="hidden" id="register">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script-login.js"></script>
</body>

</html>