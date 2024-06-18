<section id="main-content">
    <section class="wrapper">
        <?php

        @include 'config.php';

        if (isset($_POST['submit'])) {

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $pass = md5($_POST['password']);
            $user_type = $_POST['user_type'];

            $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

            $result = mysqli_query($conn, $select);

            if (mysqli_num_rows($result) > 0) {

                $error[] = 'user already exist!';
            } else {
                $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
                mysqli_query($conn, $insert);
                $success = 'Tambah Data Sukses';
            }
        };
        ?>
        <br><br>
        <h3>DAFTAR AKUN ADMIN/USER</h3><br>
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            };
        };
        ?>
        <?php
        if (isset($success)) {
            echo '<span class="success-msg">' . $success . '</span>';
        }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Nama Pengguna:</label>
                <input type="text" id="name" name="name" Required placeholder="Nama Pengguna" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" Required placeholder="Email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" Required placeholder="Kata Sandi" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Jenis User:</label>
                <select name="user_type" id="user_type" class="form-control">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Daftar" class="btn btn-primary"></input>
        </form>
        </div><br><br><br><br>
    </section>
</section>