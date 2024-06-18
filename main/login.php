<?php
@ob_start();
session_start();
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

    <!--login-->
    <div class="container" id="container">
        <div class="form-container sign-in">
            <?php
            if (isset($_POST['submit'])) {
                @include 'config.php';
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $pass = md5($_POST['password']);

                $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

                $result = mysqli_query($conn, $select);

                if (mysqli_num_rows($result) > 0) {

                    $row = mysqli_fetch_array($result);

                    if ($row['user_type'] == 'admin') {
                        $_SESSION['admin_name'] = $row['name'];
                        header('location:admin/index.php');
                    } elseif ($row['user_type'] == 'user') {
                        $_SESSION['user_name'] = $row['name'];
                        header('location:pembeli/pembeli.php');
                    }
                } else {
                    $error[] = 'incorrect email or password!';
                }
            };
            ?>
            <form action="" method="post">
                <h3>MASUK MODE PELANGGAN</h3>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    };
                };
                ?>
                <input type="email" name="email" placeholder="Email" autofocus>
                <input type="password" name="password" placeholder="Kata Sandi">
                <input type="hidden" name="user_type" value="user">
                <input type="submit" name="submit" value="Masuk Sekarang" class="form-btn">
                <p>Belum Punya Akun? <a href="register.php">Daftar Sekarang</a></p>
            </form>
        </div>
        <div class="form-container sign-up">
            <?php
            if (isset($_POST['proses'])) {
                require 'configg.php';

                $user = strip_tags($_POST['user']);
                $pass = strip_tags($_POST['pass']);

                $sql = 'select member.*, login.user, login.pass
				from member inner join login on member.id_member = login.id_member
				where user =? and pass = md5(?)';
                $row = $config->prepare($sql);
                $row->execute(array($user, $pass));
                $jum = $row->rowCount();
                if ($jum > 0) {
                    $hasil = $row->fetch();
                    $_SESSION['admin'] = $hasil;
                    echo '<script>alert("Login Sukses");window.location="penjual/index.php"</script>';
                } else {
                    echo '<script>alert("Login Gagal");history.go(-1);</script>';
                }
            }
            ?>
            <form class="form-login" method="POST">
                <h3>MASUK MODE PENJUAL</h3>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    };
                };
                ?>
                <input type="text" class="form-control" name="user" placeholder="User ID" autofocus>
                <input type="password" class="form-control" name="pass" placeholder="Password">
                <button class="btn btn-primary btn-block" name="proses" type="submit">Masuk</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Halo Rekk!</h1>
                    <p>Masuk Dengan Mode Pelanggan</p>
                    <!--<a href="penjual/login_penjual.php">Masuk</a>-->
                    <button class="hidden" id="login">Masuk</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Halo Rekk!</h1>
                    <p>Masuk Dengan Mode Penjual</p>
                    <!--<a href="penjual/login_penjual.php">Masuk</a>-->
                    <button class="hidden" id="register">Masuk</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/script-login.js"></script>
</body>

</html>