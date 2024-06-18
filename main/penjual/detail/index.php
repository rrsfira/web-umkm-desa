<?php
// Include file koneksi
include 'koneksi.php';

// Get the specific order ID (assuming it's passed as a query parameter)
$id_pemesanan = isset($_GET['id_pemesanan']) ? intval($_GET['id_pemesanan']) : 0;

// SQL query to fetch order details
$order_sql = "SELECT * FROM pemesanan WHERE id_pemesanan = $id_pemesanan";
$order_result = $conn->query($order_sql);
$order = $order_result->fetch_assoc();

// SQL query to fetch the required product details
$product_sql = "SELECT 
                    pp.id_pemesanan, 
                    b.nama_barang, 
                    b.harga_jual, 
                    pp.jumlah, 
                    (b.harga_jual * pp.jumlah) AS subharga
                FROM pemesanan_produk pp
                JOIN barang b ON pp.id_barang = b.id_barang
                WHERE pp.id_pemesanan = $id_pemesanan";

$product_result = $conn->query($product_sql);
?>

<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart"><br>
                <h3>Detail Pemesanan</h3><br><br><br>
                <?php if ($order): ?>
                <div class="order-details">
                    <p><strong>ID Pemesanan:</strong> <?php echo htmlspecialchars($order['id_pemesanan']); ?></p>
                    <p><strong>Tanggal Pemesanan:</strong> <?php echo htmlspecialchars($order['tanggal_pemesanan']); ?></p>
                    <p><strong>Total Belanja:</strong> <?php echo number_format($order['total_belanja'], 2, ',', '.'); ?></p>
                    <p><strong>Periode:</strong> <?php echo htmlspecialchars($order['periode']); ?></p>
                </div>
                <?php endif; ?>
                <div class="modal-view">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr style="background:#DFF0D8;color:#333;">
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Harga Jual</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_bayar = 0;
                            if ($product_result->num_rows > 0) {
                                $no = 1;
                                while ($row = $product_result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $no++ . "</td>
                                            <td>" . htmlspecialchars($row['nama_barang']) . "</td>
                                            <td>" . number_format($row['harga_jual'], 2, ',', '.') . "</td>
                                            <td>" . htmlspecialchars($row['jumlah']) . "</td>
                                            <td>" . number_format($row['subharga'], 2, ',', '.') . "</td>
                                          </tr>";
                                    $total_bayar += $row['subharga'];
                                }
                                echo "<tr>
                                        <td colspan='4' style='text-align:right'><strong>Total Bayar:</strong></td>
                                        <td><strong>" . number_format($total_bayar, 2, ',', '.') . "</strong></td>
                                      </tr>";
                            } else {
                                echo "<tr><td colspan='5'>Tidak ada data pemesanan.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
    </section>
</section>

<?php
// Tutup koneksi
$conn->close();
?>
