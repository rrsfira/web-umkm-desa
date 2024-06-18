<?php
session_start();
require '../../config.php';
if(!empty($_GET['member'])){
    $nm_member = $_POST['nm_member'];
    $alamat_member = $_POST['alamat_member'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $NIK = $_POST['NIK'];

    $data[] = $nm_member;
    $data[] = $alamat_member;
    $data[] = $telepon;
    $data[] = $email;
    $data[] = $NIK;
    $sql = 'INSERT INTO member (nm_member, alamat_member, telepon, email, NIK) 
            VALUES (?,?,?,?,?) ';
    $row = $config -> prepare($sql);
    $row -> execute($data);
    echo '<script>window.location="../../index.php?page=akunpenjual/akun&success=tambah-data"</script>';
}
if(!empty($_GET['akun'])){
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    $id_member = $_POST['id_member'];

    $data[] = $user;
    $data[] = $pass;
    $data[] = $id_member;
    $sql = 'INSERT INTO login (user, pass, id_member) 
            VALUES (?,?,?) ';
    $row = $config -> prepare($sql);
    $row -> execute($data);
    echo '<script>window.location="../../index.php?page=akunpenjual&success=tambah-data"</script>';
}