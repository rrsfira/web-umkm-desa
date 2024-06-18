<?php 
    @ob_start();
    session_start();

    // Ensure $view is defined properly
    require 'config.php';
    include $view;
    $lihat = new view($config);
    $admin = $lihat -> admin();
    
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
?>
