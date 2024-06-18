<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart"><br>
                <h3>Data Penjual</h3><br><br><br>
                <div class="modal-view">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr style="background:#DFF0D8;color:#333;">
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Alamat Toko</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No Telp</th>
                            </tr>
                        </thead>
                        <tbody>
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

                            // Fetch data from the database for accepted users only
                            $sql = "SELECT * FROM users WHERE status = 'Diterima'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr id='row-" . $row["id"] . "'>";
                                    echo "<td data-label='ID'>" . $row["id"] . "</td>";
                                    echo "<td data-label='Nama'>" . $row["nama"] . "</td>";
                                    echo "<td data-label='Gender'>" . $row["gender"] . "</td>";
                                    echo "<td data-label='Alamat Toko'>" . $row["alamattoko"] . "</td>";
                                    echo "<td data-label='Alamat'>" . $row["alamat"] . "</td>";
                                    echo "<td data-label='Email'>" . $row["email"] . "</td>";
                                    echo "<td data-label='No Telp'>" . $row["notelp"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>0 results</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table><br><br><br><br><br><br><br><br>
                </div>
            </div>
        </div>
    </section>
</section>
