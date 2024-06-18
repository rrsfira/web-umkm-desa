<?php 
    @ob_start();
    session_start();

    // Memeriksa apakah session admin sudah ada atau tidak
    if(isset($_SESSION['admin'])) {
        require 'configg.php';
        include $view;
        $lihat = new view($config);
        $toko = $lihat -> toko();
        
        // Admin
        include 'admin/template/header.php';
        include 'admin/template/sidebar.php';
        
        if(!empty($_GET['page'])) {
            // Memuat halaman modul jika parameter 'page' disediakan
            include 'admin/module/'.$_GET['page'].'/index.php';
        } else {
            // Memuat halaman utama jika parameter 'page' tidak disediakan
            include 'admin/template/home.php';
        }
        
        include 'admin/template/footer.php';
        // Selesai Admin
    } else {
        // Jika session admin belum ada, tetapkan session admin sementara
        // Ini hanya contoh, Anda harus menggantinya dengan logika autentikasi yang tepat
        $_SESSION['admin'] = true;

        // Redirect ke halaman login
        echo '<script>window.location="../login.php";</script>';
    }
?>
