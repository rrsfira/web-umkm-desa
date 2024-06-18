<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    <!-- Include CSS and JavaScript libraries as needed (Bootstrap, jQuery, etc.) -->
</head>
<body>
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12 main-chart"><br>
                    <h3>Data User</h3><br><br><br>
                    <div class="modal-view">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr style="background:#DFF0D8;color:#333;">
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>User Type</th>
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

                                // Fetch data from the database
                                $sql = "SELECT * FROM user_form";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr id='row-" . $row["id"] . "'>";
                                        echo "<td data-label='ID'>" . $row["id"] . "</td>";
                                        echo "<td data-label='Nama'>" . $row["name"] . "</td>";
                                        echo "<td data-label='Email'>" . $row["email"] . "</td>";
                                        echo "<td data-label='User Type'>" . $row["user_type"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>0 results</td></tr>";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</body>
</html>
