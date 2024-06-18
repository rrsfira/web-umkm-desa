<?php 
	$id = $_GET['member'];
?>
<section id="main-content">
    <section class="wrapper">
        <h2>Buat Akun Password</h2><br><br>
        <?php if (isset($_GET['success'])) { ?>
 					<div class="alert alert-success">
 						<p>Tambah Data Berhasil !</p>
 					</div>
 				<?php } ?>
        <form action="fungsi/tambah/tambah.php?akun=tambah" method="post">
            <div class="form-group">
                <label for="user">Username:</label>
                <input type="text" id="user" name="user" required class="form-control">
            </div>
            <div class="form-group">
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required class="form-control">
            </div>
            <div class="form-group">
                <label for="id_member">Id Member:</label>
                <input type="text" id="id_member" name="id_member" required class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn">
            </div>
        </form><br><br><br><br><br><br><br><br><br><br>
    </section>
</section>
