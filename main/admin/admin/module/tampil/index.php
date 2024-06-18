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

// Handle status update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    // Validate input
    if (empty($id) || empty($action)) {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
        $conn->close();
        exit;
    }

    // Sanitize input
    $id = $conn->real_escape_string($id);
    $action = $conn->real_escape_string($action);

    // Prepare SQL query
    if ($action == 'accept') {
        $sql = "UPDATE users SET terima = '1', tolak = '0', status = 'Diterima' WHERE id = '$id'";
    } elseif ($action == 'reject') {
        $sql = "UPDATE users SET terima = '0', tolak = '1', status = 'Data Ditolak' WHERE id = '$id'";
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid action"]);
        $conn->close();
        exit;
    }

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }

    $conn->close();
    exit;
}

// Fetch data from the database for display
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<head>
    <title>Verifikasi Data Penjual</title>
    <style>
        .accepted {
            background-color: #DFF0D8;
        }
        .rejected {
            background-color: #F2DEDE;
        }
    </style>
</head>
<body>
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 main-chart"><br>
                <h3>Verifikasi Data Penjual</h3><br><br><br>
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
                                <th>PDF File</th>
                                <th>Actions</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $rowClass = '';
                                    $statusText = '';
                                    $statusColor = '';

                                    if ($row['terima'] == 1) {
                                        $rowClass = 'accepted';
                                        $statusText = 'Diterima';
                                        $statusColor = 'green';
                                    } else if ($row['tolak'] == 1) {
                                        $rowClass = 'rejected';
                                        $statusText = 'Data Ditolak';
                                        $statusColor = 'red';
                                    } else {
                                        $statusText = $row['status'];
                                        $statusColor = 'orange';
                                    }

                                    echo "<tr id='row-" . $row["id"] . "' class='" . $rowClass . "'>";
                                    echo "<td data-label='ID'>" . $row["id"] . "</td>";
                                    echo "<td data-label='Nama'>" . $row["nama"] . "</td>";
                                    echo "<td data-label='Gender'>" . $row["gender"] . "</td>";
                                    echo "<td data-label='Alamat Toko'>" . $row["alamattoko"] . "</td>";
                                    echo "<td data-label='Alamat'>" . $row["alamat"] . "</td>";
                                    echo "<td data-label='Email'>" . $row["email"] . "</td>";
                                    echo "<td data-label='No Telp'>" . $row["notelp"] . "</td>";
                                    echo "<td data-label='PDF File'><a href='pdf.php?pdf=" . $row["pdfFile"] . "'>Download PDF</a></td>";
                                    echo "<td class='action-buttons' data-label='Actions'>
                                            <button onclick='updateStatus(this, " . $row["id"] . ", \"accept\")' " . ($row['terima'] == 1 || $row['tolak'] == 1 ? 'disabled' : '') . ">Accepted</button>
                                            <button onclick='updateStatus(this, " . $row["id"] . ", \"reject\")' " . ($row['terima'] == 1 || $row['tolak'] == 1 ? 'disabled' : '') . ">Rejected</button>
                                          </td>";
                                    echo "<td data-label='Status' style='color: " . $statusColor . "; font-weight: bold;'>" . $statusText . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='10'>0 results</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    function updateStatus(button, id, action) {
                        var row = button.closest('tr');
                        var statusText = action === 'accept' ? 'Diterima' : 'Data Ditolak';
                        var color = action === 'accept' ? 'green' : 'red';

                        // Disable the buttons to prevent multiple clicks
                        var buttons = row.querySelectorAll('.action-buttons button');
                        buttons.forEach(function(btn) {
                            btn.disabled = true;
                        });

                        // AJAX request to update the database
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "", true);  // Request URL is the same file
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.status === "success") {
                                    button.classList.add('clicked');
                                    row.classList.add(action === 'accept' ? 'accepted' : 'rejected');
                                    var statusCell = row.querySelector('td:nth-child(10)');
                                    statusCell.textContent = statusText;
                                    statusCell.style.color = color;
                                    statusCell.style.fontWeight = 'bold';
                                } else {
                                    console.error("Error updating status: " + response.message);
                                    // Re-enable buttons in case of error
                                    buttons.forEach(function(btn) {
                                        btn.disabled = false;
                                    });
                                }
                            }
                        };
                        xhr.send("id=" + id + "&action=" + action);
                    }
                </script>
            </div>
        </div>
    </section>
</section>
