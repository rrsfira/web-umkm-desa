<?php 
session_start();

$id_barang = $_GET['id_barang'];

if (isset($_SESSION['pesanan'][$id_barang]))
{
	$_SESSION['pesanan'][$id_barang]+=1;
}

else 
{
	$_SESSION['pesanan'][$id_barang]=1;
}

echo "<script>alert('Produk telah masuk ke pesanan anda');</script>";
echo "<script>location= 'pesanan_pembeli.php'</script>";

 ?>