<!--sidebar end-->

<!-- ******************************************************MAIN CONTENT********************************************************* -->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-9">
				<div class="row" style="margin-left:1pc;margin-right:1pc;">
					<h1>DASHBOARD</h1>
					<hr>
					<?php $hasil_users = $lihat->users_row(); ?>
					<?php $hasil_userform = $lihat->userform_row(); ?>
					<div class="row">
						<!--STATUS PANELS -->
						<div class="col-md-6">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h5><i class="fa fa-desktop"></i> Pendaftar Penjual</h5>
								</div>
								<div class="panel-body">
									<center>
										<h1><?php echo number_format($hasil_users); ?></h1>
									</center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=tampil'>Tabel Verifikasi<i class='fa fa-angle-double-right'></i></a></h4>
								</div>
							</div><!--/grey-panel -->
						</div><!-- /col-md-6-->
						<!-- STATUS PANELS -->
						<div class="col-md-6">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h5><i class="fa fa-desktop"></i> Data Pengguna</h5>
								</div>
								<div class="panel-body">
									<center>
										<h1><?php echo number_format($hasil_userform); ?></h1>
									</center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;font-weight:700;"><a href='index.php?page=datauser'>Data Pengguna<i class='fa fa-angle-double-right'></i></a></h4>
								</div>
							</div><!--/grey-panel -->
						</div><!-- /col-md-6-->
					</div>
				</div>
			</div><!-- /col-lg-9 END SECTION MIDDLE -->

			<!-- Donut Chart for User Status -->
			<div class="col-lg-3">
				<div style="margin-top: 70px;">
					<canvas id="donutChart" width="200" height="200"></canvas>
				</div>
			</div><!-- /col-lg-3 -->
		</div><br><br><br><br><br><br><br><br>
	</section>
</section>

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	<?php
	// Database connection settings
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'db_pabean';

	try {
		$config = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);
		$config->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo 'KONEKSI GAGAL ' . $e->getMessage();
	}

	// Query to fetch user status counts
	$sql = "SELECT COUNT(*) as count, status FROM users GROUP BY status";
	$stmt = $config->query($sql);
	$status_counts = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Prepare data for Chart.js
	$labels = [];
	$data = [];
	$colors = ['#36a2eb', '#ff6384', '#ffce56']; // Blue, Red, Yellow

	foreach ($status_counts as $row) {
		$labels[] = $row['status'];
		$data[] = $row['count'];
	}
	?>
	// Donut chart configuration
	const donutChartCtx = document.getElementById('donutChart').getContext('2d');
	const donutChartConfig = {
		type: 'doughnut',
		data: {
			labels: <?php echo json_encode($labels); ?>,
			datasets: [{
				label: 'Status User',
				data: <?php echo json_encode($data); ?>,
				backgroundColor: <?php echo json_encode($colors); ?>,
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			plugins: {
				legend: {
					position: 'top',
				},
				tooltip: {
					callbacks: {
						label: function(tooltipItem) {
							return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString();
						}
					}
				}
			}
		}
	};
	new Chart(donutChartCtx, donutChartConfig);
</script>