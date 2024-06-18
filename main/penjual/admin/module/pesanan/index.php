<?php
include('koneksi.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if (empty($id) || $action !== 'mark_as_paid') {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
        exit;
    }

    $id = $koneksi->real_escape_string($id);

    $sql = "UPDATE pemesanan SET status_pembayaran = '1' WHERE id_pemesanan = '$id'";

    if ($koneksi->query($sql) === TRUE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $koneksi->error]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Online</title>
    <style>
        .badge {
            padding: 5px 10px;
            text-decoration: none;
        }
        .badge-primary {
            background-color: #007bff;
            color: #fff;
        }
        .badge-success {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>
<body>
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12 main-chart"><br>
          <h3>Pemesanan Online</h3><br><br><br>
          <div class="modal-view">
            <table class="table table-bordered table-striped" id="example1">
              <thead>
                <tr style="background:#DFF0D8;color:#333;">
                  <th>No.</th>
                  <th>ID Pemesanan</th>
                  <th>Tanggal Pesan</th>
                  <th>Total Bayar</th>
                  <th>Opsi</th>
                  <th>Status Pembayaran</th>
                </tr>
              </thead>
              <tbody>
              <?php $nomor=1; ?>
              <?php 
                $ambil = mysqli_query($koneksi, 'SELECT * FROM pemesanan');
                $result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
              ?>
              <?php foreach($result as $result) : ?>

              <tr>
                <th scope="row"><?php echo $nomor; ?></th>
                <td><?php echo $result["id_pemesanan"]; ?></td>
                <td><?php echo $result["tanggal_pemesanan"]; ?></td>
                <td>Rp. <?php echo number_format($result["total_belanja"]); ?></td>
                <td>
                  <a href="index.php?page=pesanan/detail&id=<?php echo $result['id_pemesanan'] ?>" class="badge badge-primary">Detail</a>
                  <a href="print_nota.php?id=<?php echo $result['id_pemesanan'] ?>" class="btn btn-danger btn-sm">Print Nota</a>
                  <?php if($result["status_pembayaran"] != '1'): ?>
                  <button onclick="markAsPaid('<?php echo $result['id_pemesanan']; ?>')" class="badge badge-success">Telah Dibayar</button>
                  <?php endif; ?>
                </td>
                <td><?php echo $result["status_pembayaran"] == '1' ? 'Telah Dibayar' : 'Belum Dibayar'; ?></td>
              </tr>
              <?php $nomor++; ?>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><br><br><br><br><br><br><br><br>
    </section>
  </section>

  <script>
    function markAsPaid(id) {
      if(confirm('Are you sure you want to mark this order as paid?')) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if(xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.status == 'success') {
              alert('Status updated successfully!');
              location.reload();
            } else {
              alert('Error updating status: ' + response.message);
            }
          }
        };
        xhr.send('id=' + id + '&action=mark_as_paid');
      }
    }
  </script>
</body>
</html>
