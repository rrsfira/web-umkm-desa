<section id="main-content">
    <section class="wrapper">
        <br><br>
        <h3>DAFTAR AKUN PENJUAL</h3><br>
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success">
                <p>Tambah Data Berhasil !</p>
            </div>
        <?php } ?>
        <form action="fungsi/tambah/tambah.php?member=tambah" method="POST">
            <div class="form-group">
                <label for="nm_member">Nama Member:</label>
                <input type="text" id="nm_member" name="nm_member" Required placeholder="Nama Member" class="form-control">
            </div>

            <div class="form-group">
                <label for="alamat_member">Alamat:</label>
                <input type="text" id="alamat_member" name="alamat_member" Required placeholder="Alamat Member" class="form-control">
            </div>

            <div class="form-group">
                <label for="telepon">Nomor Telepon:</label>
                <input type="text" id="telepon" name="telepon" Required placeholder="Nomor telepon" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" Required placeholder="Email" class="form-control">
            </div>

            <div class="form-group">
                <label for="NIK">NIK:</label>
                <input type="text" id="NIK" name="NIK" Required placeholder="NIK" class="form-control">
            </div>

            <input type="submit" name="submit" value="Daftar" class="btn btn-primary">
        </form>
        </div><br><br><br><br>
    </section>
</section>