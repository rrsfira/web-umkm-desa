<!--sidebar end-->

<!-- ******************************************************MAIN CONTENT********************************************************* -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">

        <div class="row">
                <div class="row" style="margin-left:1pc;margin-right:1pc;">
                    <h1>DASHBOARD</h1>
                    <hr>
                  
                    <?php 
                        $sql=" select * from barang where stok <= 3";
                        $row = $config -> prepare($sql);
                        $row -> execute();
                        $r = $row -> rowCount();
                        if($r > 0){
                    ?>  
                    <?php
                            echo "
                            <div class='alert alert-warning'>
                                <span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
                                <span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
                            </div>
                            ";  
                        }
                    ?>
                    <?php $hasil_barang = $lihat -> barang_row();?>
                    <?php $hasil_kategori = $lihat -> kategori_row();?>
                    <?php $stok = $lihat -> barang_stok_row();?>
                    <?php $jual = $lihat -> jual_row();?>
                    
                    <div class="row">
                        <!--STATUS PANELS -->
                        <div class="col-md-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5><i class="fa fa-desktop"></i> Nama Barang</h5>
                                </div>
                                <div class="panel-body">
                                    <center><h1><?php echo number_format($hasil_barang);?></h1></center>
                                </div>
                                <div class="panel-footer">
                                    <h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></h4>
                                </div>
                            </div><!--/grey-panel -->
                        </div><!-- /col-md-3-->
                        <!-- STATUS PANELS -->
                        <div class="col-md-3">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h5><i class="fa fa-desktop"></i> Stok Barang</h5>
                                </div>
                                <div class="panel-body">
                                    <center><h1><?php echo number_format($stok['jml']);?></h1></center>
                                </div>
                                <div class="panel-footer">
                                    <h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Tabel Barang  <i class='fa fa-angle-double-right'></i></a></h4>
                                </div>
                            </div><!--/grey-panel -->
                        </div><!-- /col-md-3-->
                        <!-- STATUS PANELS -->
                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h5><i class="fa fa-desktop"></i> Telah Terjual</h5>
                                </div>
                                <div class="panel-body">
                                    <center><h1><?php echo number_format($jual['stok']);?></h1></center>
                                </div>
                                <div class="panel-footer">
                                    <h4 style="font-size:15px;font-weight:700;font-weight:700;"><a href='index.php?page=laporan'>Tabel laporan  <i class='fa fa-angle-double-right'></i></a></h4>
                                </div>
                            </div><!--/grey-panel -->
                        </div><!-- /col-md-3-->
                        <div class="col-md-3">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h5><i class="fa fa-desktop"></i> Kategori Barang</h5>
                                </div>
                                <div class="panel-body">
                                    <center><h1><?php echo number_format($hasil_kategori);?></h1></center>
                                </div>
                                <div class="panel-footer">
                                    <h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=kategori'>Tabel Kategori  <i class='fa fa-angle-double-right'></i></a></h4>
                                </div>
                            </div><!--/grey-panel -->
                        </div><!-- /col-md-3-->
                    </div>
            </div><!-- /col-lg-9 END SECTION MIDDLE -->

            <!-- ****************************************************RIGHT SIDEBAR CONTENT************************************************* -->                  

        </div><!--/row --><br><br>
        
        <div class="row" style="margin-left:1pc;margin-right:1pc;">
            <!-- Begin PHP for sales data -->
            <?php
                $host   = 'localhost'; // host server
                $user   = 'root';  // username server
                $pass   = ''; // password server, kalau pakai xampp kosongin saja
                $dbname = 'db_pabean'; // nama database anda
                
                try {
                    $config = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);
                    $config->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $e) {
                    echo 'KONEKSI GAGAL ' . $e->getMessage();
                }

                // Query untuk mendapatkan data penjualan offline
                $sql_offline = "SELECT periode, SUM(total) as total_penjualan FROM nota GROUP BY periode";
                $result_offline = $config->query($sql_offline);

                $penjualan_offline = [];
                while ($row = $result_offline->fetch(PDO::FETCH_ASSOC)) {
                    $penjualan_offline[$row['periode']] = $row['total_penjualan'];
                }

                // Query untuk mendapatkan data penjualan online
                $sql_online = "SELECT periode, SUM(total_belanja) as total_penjualan FROM pemesanan GROUP BY periode";
                $result_online = $config->query($sql_online);

                $penjualan_online = [];
                while ($row = $result_online->fetch(PDO::FETCH_ASSOC)) {
                    $penjualan_online[$row['periode']] = $row['total_penjualan'];
                }

                // Gabungkan data untuk periode yang ada
                $periode = array_unique(array_merge(array_keys($penjualan_offline), array_keys($penjualan_online)));
                sort($periode);

                $penjualan_offline_data = [];
                $penjualan_online_data = [];
                foreach ($periode as $p) {
                    $penjualan_offline_data[] = isset($penjualan_offline[$p]) ? $penjualan_offline[$p] : 0;
                    $penjualan_online_data[] = isset($penjualan_online[$p]) ? $penjualan_online[$p] : 0;
                }
            ?>

            <!-- Chart.js canvases and script -->
            <div class="row">
                <center><div class="col-md-6">
                    <div style="width: 100%; margin: auto;">
                        <canvas id="lineChart" width="600" height="400"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="width: 100%; margin: auto;">
                        <canvas id="barChart" width="600" height="400"></canvas>
                    </div>
                </div></center>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Data for the charts
                const labels = <?php echo json_encode($periode); ?>;
                const offlineData = <?php echo json_encode($penjualan_offline_data); ?>;
                const onlineData = <?php echo json_encode($penjualan_online_data); ?>;
                
                // Line chart configuration
                const lineChartCtx = document.getElementById('lineChart').getContext('2d');
                const lineChartConfig = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Penjualan Offline',
                                data: offlineData,
                                backgroundColor: '#ffc800',
                                borderColor: '#ffc800',
                                borderWidth: 1,
                                fill: false
                            },
                            {
                                label: 'Penjualan Online',
                                data: onlineData,
                                backgroundColor: '#4b553a',
                                borderColor: '#4b553a',
                                borderWidth: 1,
                                fill: false
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };
                new Chart(lineChartCtx, lineChartConfig);

                // Bar chart configuration
                const barChartCtx = document.getElementById('barChart').getContext('2d');
                const barChartConfig = {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Penjualan Offline',
                                data: offlineData,
                                backgroundColor: '#ffc800',
                                borderColor: '#ffc800',
                                borderWidth: 1
                            },
                            {
                                label: 'Penjualan Online',
                                data: onlineData,
                                backgroundColor: '#4b553a',
                                borderColor: '#4b553a',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };
                new Chart(barChartCtx, barChartConfig);
            </script>
        </div>
        
        <div class="clearfix" style="padding-top:18%;"></div>
    </section>
</section>
