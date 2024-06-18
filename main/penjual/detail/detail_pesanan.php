<?php
include('koneksi.php');
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

</head>

<body style="background-color:#c3c6b1;">


  <!-- Menu -->
  <div class="container">
    <div class="judul-pesanan mt-5">

      <h3 class="text-center font-weight-bold">DETAIL PESANAN PELANGGAN</h3>

    </div>
    <table class="table table-bordered" id="example">
      <thead class="thead-light">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">ID Pemesanan</th>
          <th scope="col">Nama Pesanan</th>
          <th scope="col">Harga</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Subharga</th>
        </tr>
      </thead>
      <tbody>
        <?php $nomor = 1; ?>
        <?php $totalbelanja = 0; ?>
        <?php
        $id_pemesanan = $_GET['id'];
        $ambil = $koneksi->query("SELECT * FROM pemesanan_produk JOIN barang ON pemesanan_produk.id_barang = barang.id_barang 
             WHERE pemesanan_produk.id_pemesanan = '$id_pemesanan'");

        ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
          <?php $subharga1 = $pecah['harga_jual'] * $pecah['jumlah']; ?>
          <tr>
            <th scope="row"><?php echo $nomor; ?></th>
            <td><?php echo $pecah['id_pemesanan_produk']; ?></td>
            <td><?php echo $pecah['nama_barang']; ?></td>
            <td>Rp. <?php echo number_format($pecah['harga_jual']); ?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>
              Rp. <?php echo number_format($pecah['harga_jual'] * $pecah['jumlah']); ?>
            </td>
          </tr>
          <?php $nomor++; ?>
          <?php $totalbelanja += $subharga1; ?>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="5">Total Bayar</th>
          <th>Rp. <?php echo number_format($totalbelanja) ?></th>
        </tr>
      </tfoot>
    </table><br>

    <form method="POST" action="">
      <a href="pesanan.php" class="btn btn-success btn-sm">Kembali</a>
      <button class="btn btn-primary btn-sm" name="bayar">Konfirmasi Pembayaran</button>
    </form>
    <?php
    if (isset($_POST["bayar"])) {
      echo "<script>alert('Pesanan Telah Dibayar !');</script>";
      echo "<script>location= 'pesanan.php'</script>";
    }
    ?>

  </div>
  <!-- Akhir Menu -->






  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
</body>

</html>