<?php
include('koneksi.php');
session_start();

  $id_pemesanan = $_GET['id'];
  $ambil = $koneksi->query("SELECT * FROM pemesanan_produk WHERE id_pemesanan='$id_pemesanan'");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Print Nota</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <script>
        window.print();
    </script>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"><br><br><br><br><br><br>
                <center>
            <?php 
            include('koneksi.php');
            $query = mysqli_query($koneksi, 'SELECT * FROM toko');
            $resultt = mysqli_fetch_all($query, MYSQLI_ASSOC);
            ?>
            <?php foreach($resultt as $resultt) ; ?>
                    <p><?php echo $resultt['nama_toko']; ?></p>
                    <p><?php echo $resultt['alamat_toko']; ?></p>
                    <p>Tanggal: <?php echo date("j F Y, G:i"); ?></p>
                </center>
                <table class="table table-bordered" style="width:100%;"><br>
                    <thead>
                        <th>No.</th>
                        <th>ID Pemesanan</th>
                        <th>Nama Pesanan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        $totalbelanja = 0;
                        $ambil = $koneksi->query("SELECT * FROM pemesanan_produk JOIN barang ON pemesanan_produk.id_barang=barang.id_barang WHERE pemesanan_produk.id_pemesanan='$_GET[id]'");
                        while ($pecah = $ambil->fetch_assoc()) {
                            $subharga1 = $pecah['harga_jual'] * $pecah['jumlah'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $nomor; ?></th>
                                <td><?php echo $pecah['id_pemesanan']; ?></td>
                                <td><?php echo $pecah['nama_barang']; ?></td>
                                <td>Rp. <?php echo number_format($pecah['harga_jual']); ?></td>
                                <td><?php echo $pecah['jumlah']; ?></td>
                                <td>Rp. <?php echo number_format($subharga1); ?></td>
                            </tr>
                        <?php
                            $nomor++;
                            $totalbelanja += $subharga1;
                        } ?>
                    </tbody>
                </table>
                <div class="pull-right"><br>
                    Total: Rp. <?php echo number_format($totalbelanja); ?>,-
                    <br />
                </div>
                <div class="clearfix"></div><br>
                <center>
                    <p>Terima Kasih Telah berbelanja di toko kami!</p>
                </center>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>