<?php
include('koneksi.php');
session_start();

// Function to reduce stock
if (isset($_POST['pay'])) {
  $id_pemesanan = $_GET['id'];
  $ambil = $koneksi->query("SELECT * FROM pemesanan_produk WHERE id_pemesanan='$id_pemesanan'");
  while ($pecah = $ambil->fetch_assoc()) {
    $id_barang = $pecah['id_barang'];
    $jumlah = $pecah['jumlah'];
    // Update the stock in the barang table
    $koneksi->query("UPDATE barang SET stok = stok - $jumlah WHERE id_barang='$id_barang'");
  }
  // Redirect to a confirmation page or display a message
  echo "<script>alert('Payment successful and stock updated!');</script>";
  echo "<script>location='index.php?page=pesanan';</script>";
}

?>
<body>
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12 main-chart"><br>
          <h3>DETAIL PESANAN</h3><br><br><br>
          <div class="modal-view">
            <table class="table table-bordered table-striped" id="example1">
              <thead>
                <tr style="background:#DFF0D8;color:#333;">
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
                $nomor=1; 
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
              <tfoot>
                <tr>
                  <th colspan="5">Total Bayar</th>
                  <th>Rp. <?php echo number_format($totalbelanja); ?></th>
                </tr>
              </tfoot>
            </table><br>
            <form method="POST" action="">
              <a href="index.php?page=pesanan" class="btn btn-success btn-sm">Kembali</a>
              <button type="submit" name="pay" class="btn btn-primary btn-sm">Bayar</button>
            </form> 
          </div>
        </div>
      </div><br><br><br><br><br><br><br><br>
    </section>
  </section>
</body>
