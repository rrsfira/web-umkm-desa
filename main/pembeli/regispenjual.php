<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'db_pabean';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST["nama"];
  $gender = $_POST["gender"];
  $alamattoko = $_POST["alamattoko"];
  $alamat = $_POST["alamat"];
  $email = $_POST["email"];
  $notelp = $_POST["notelp"];
  $pdfFile = $_FILES["pdfFile"];

  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mimeType = finfo_file($finfo, $_FILES["pdfFile"]["tmp_name"]);
  finfo_close($finfo);
  
  // Check if the file is valid
  if ($mimeType == "application/pdf") {

    // Generate a unique filename
    $pdfFilename = $nama . "_" . uniqid() . ".pdf";

    // Upload the file to the server
    $pdfDir = '../admin/admin/module/tampil/pdf/';
    move_uploaded_file($pdfFile["tmp_name"], $pdfDir . $pdfFilename);

    // Insert the data into the database
    $status = "pendaftar baru";
    $sql = "INSERT INTO users (nama, gender, alamattoko, alamat, email, notelp, pdfFile, status) VALUES ('$nama', '$gender', '$alamattoko', '$alamat', '$email', '$notelp', '$pdfFilename', '$status')";
    if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Data Berhasil di Upload! Mohon Tunggu Admin Akan Segera Mengirim Akun Lewat WhatsApp");window.location="pembeli.php"</script>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo '<script>alert("Jenis File Yang Anda Kirim Salah! Harus PDF");history.go(-1);</script>';
  }
} else {
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Site Metas -->
  <link rel="shortcut icon" href="img/sidoarjo.png" type="">
  <!-- title -->
  <title>DAFTAR PENJUAL | Website Desa Pabean Sidoarjo</title>
  <link rel="stylesheet" href="css/styledaftarpenjual.css" />
  <script src="script.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="title" style="text-align: center;">Pendaftaran Usaha di Website UMKM Pabean</div>
    <div class="content">
      <div class="user-details">
        <div class="input-box">
          <form id="uploadForm" action="" method="POST" enctype="multipart/form-data">
            <div class="user-details">
              <div class="input-box">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan nama sesuai KTP" required>
              </div>
              <div class="input-box">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select id="gender" name="gender" class="form-control" required>
                  <option value="">Pilih jenis kelamin</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="input-box">
                <label for="alamattoko" class="form-label">Alamat Toko</label>
                <input type="text" id="alamattoko" name="alamattoko" class="form-control" placeholder="Masukan alamat toko" required>
              </div>
              <div class="input-box">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukan alamat rumah" required>
              </div>
              <div class="input-box">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Masukan email anda" required>
              </div>
              <div class="input-box">
                <label for="notelp" class="form-label">No WhatsApp</label>
                <input type="text" id="notelp" name="notelp" class="form-control" placeholder="Masukan nomor WhatsApp anda" required>
              </div>
              <div class="input-box">
                <label for="pdfFile" class="form-label">File terdiri dari foto KTP, foto diri, dan foto outlet toko</label>
                <label for="pdfFile" class="form-label">(dalam bentuk pdf)</label>
                <input type="file" id="pdfFile" name="pdfFile" accept=".pdf" required>
              </div>
              <div class="button" style="width: 100%;">
                <input type="submit" value="KIRIM DATA" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
