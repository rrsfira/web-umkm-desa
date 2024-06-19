<?php
include('koneksi.php');
session_start();
?>
<?php
if (empty($_SESSION["pesanan"]) or !isset($_SESSION["pesanan"])) {
  echo "<script>alert('Pesanan kosong, Silahkan Pesan dahulu');</script>";
  echo "<script>location= 'menu_pembeli.php'</script>";
}
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
    <!-- Site Metas -->
    <link rel="shortcut icon" href="images/sidoarjo.png" type="">
    <!-- tittle -->
    <title> UMKM | Website Desa Pabean Sidoarjo </title>
</head>

<body>
  <?php
  include('koneksi.php');
  $query = mysqli_query($koneksi, 'SELECT * FROM toko');
  $resultt = mysqli_fetch_all($query, MYSQLI_ASSOC);
  ?>
  <?php foreach ($resultt as $resultt) : ?>
    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid text-center">
      <div class="container">
        <h1 class="display-4"><span class="font-weight-bold"><?php echo $resultt['nama_toko'] ?></span></h1>
        <hr>
        <p class="lead font-weight-bold">Silahkan Pesan Barang Sesuai Keinginan Anda <br>Happy shopping</p>
      </div>
    </div>
    <!-- Akhir Jumbotron -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg  bg-dark">
      <div class="container">
        <a class="navbar-brand text-white" href="user.php"><strong><?php echo $resultt['nama_toko'] ?><?php endforeach; ?> </strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link mr-4" href="menu_pembeli.php">DAFTAR MENU</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="pesanan_pembeli.php">PESANAN ANDA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4" href="../pembeli.php">KEMBALI</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Menu -->
    <div class="container">
      <div class="judul-pesanan mt-5">
        <h3 class="text-center font-weight-bold">PESANAN ANDA</h3>
      </div>
      <table class="table table-bordered" id="example">
        <thead class="thead-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Pesanan</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subharga</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor = 1; ?>
          <?php $totalbelanja = 0; ?>
          <?php foreach ($_SESSION["pesanan"] as $id_barang => $jumlah) : ?>
            <?php
            include('koneksi.php');
            $ambil = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
            $pecah = $ambil->fetch_assoc();
            $subharga = $pecah["harga_jual"] * $jumlah;
            ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $pecah["nama_barang"]; ?></td>
              <td>Rp. <?php echo number_format($pecah["harga_jual"]); ?></td>
              <td><?php echo $jumlah; ?></td>
              <td>Rp. <?php echo number_format($subharga); ?></td>
              <td>
                <a href="hapus_pesanan.php?id_barang=<?php echo $id_barang ?>" class="badge badge-danger">Hapus</a>
              </td>
            </tr>
            <?php $nomor++; ?>
            <?php $totalbelanja += $subharga; ?>
          <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Total Belanja</th>
            <th colspan="2">Rp. <?php echo number_format($totalbelanja) ?></th>
          </tr>
        </tfoot>
      </table><br>
      <form method="POST" action="">
        <a href="menu_pembeli.php" class="btn btn-primary btn-sm">Lihat Menu</a>
        <button class="btn btn-success btn-sm" name="konfirm">Konfirmasi Pesanan</button>
      </form>

      <?php 
if(isset($_POST['konfirm'])) {
    // Mendapatkan tanggal, bulan, dan tahun pemesanan
    $tanggal_pemesanan = date("d-m-Y");
    $bulan = date("m");
    $tahun = date("Y");
    $periode = "$bulan-$tahun";

    // Menyimpan data ke tabel pemesanan
    $insert = mysqli_query($koneksi, "INSERT INTO pemesanan (tanggal_pemesanan, total_belanja, periode) VALUES ('$tanggal_pemesanan', '$totalbelanja', '$periode')");

    // Mendapatkan ID barusan
    $id_terbaru = $koneksi->insert_id;

    // Menyimpan data ke tabel pemesanan produk
    $pesan = "Pesanan Saya (ID: $id_terbaru):\n";
    foreach ($_SESSION["pesanan"] as $id_barang => $jumlah) {
        $ambil = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
        $pecah = $ambil->fetch_assoc();
        $subharga = $pecah["harga_jual"] * $jumlah;

        $pesan .= $pecah["nama_barang"] . " - " . $jumlah . " x Rp. " . number_format($pecah["harga_jual"]) . " = Rp. " . number_format($subharga) . "\n";

        $insert = mysqli_query($koneksi, "INSERT INTO pemesanan_produk (id_pemesanan, id_barang, jumlah, tanggal_pemesanan, periode) VALUES ('$id_terbaru', '$id_barang', '$jumlah', '$tanggal_pemesanan', '$periode')");
    }

    // Mengosongkan pesanan
    unset($_SESSION["pesanan"]);

    // Append total belanja to the message
    $pesan .= "Total Belanja: Rp. " . number_format($totalbelanja);

    // URL-encode the message
    $waMessage = urlencode($pesan);

    // Redirect to WhatsApp
    echo "<script>alert('Pemesanan Sukses!');</script>";
    echo "<script>window.location.href='https://wa.me/6281216980068?text=".$waMessage."';</script>";
}
?>

    </div>
    <!-- Akhir Menu -->

    <!-- Awal Footer -->
    <hr class="footer">
    <div class="container">
      <div class="row footer-body">
        <div class="col-md-6">
          <div class="copyright">
            <strong>Copyright</strong> <i class="far fa-copyright"></i> 2024</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Footer -->

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
