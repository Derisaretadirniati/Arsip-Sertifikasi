<?php
$total_data = $this->db->count_all('umum_puskomin');

$this->db->where('level', 'biasa');
$this->db->from('umum_puskomin');
$data_biasa =  $this->db->count_all_results();
if ($data_biasa != null) {
	$persentase_dataBiasa = $data_biasa / $total_data * 100;
} else {
	$persentase_dataBiasa = 0;
}

$this->db->where('level', 'segera');
$this->db->from('umum_puskomin');
$data_segera =  $this->db->count_all_results();
if ($data_segera != null) {
	$persentase_dataSegera = $data_segera / $total_data * 100;
} else {
	$persentase_dataSegera = 0;
}

$this->db->where('level', 'penting');
$this->db->from('umum_puskomin');
$data_penting =  $this->db->count_all_results();
if ($data_penting != null) {
	$persentase_dataPenting = $data_penting / $total_data * 100;
} else {
	$persentase_dataPenting = 0;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>
	<!-- Content Row -->
	<div class="row">
		<!-- Content Column -->
		<div class="col-lg-12 mb-4">
			<!-- Project Card Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Data Puskomin</h6>
				</div>
				<div class="card-body">
					<div class="chart-pie pt-4">
						<canvas id="myPieChart"></canvas>
					</div>
					<h4 class="small font-weight-bold">
						Biasa <span class="float-right"><?= $persentase_dataBiasa ?>%</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar" role="progressbar" style="width: <?= $persentase_dataBiasa ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Penting <span class="float-right"><?= $persentase_dataPenting ?>%</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-info" role="progressbar" style="width: <?= $persentase_dataPenting ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Segera <span class="float-right"><?= $persentase_dataSegera ?>%</span>
					</h4>
					<div class="progress">
						<div class="progress-bar bg-success" role="progressbar" style="width: <?= $persentase_dataSegera ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script src="<?= base_url('assets/vendor/admin/chart.js/Chart.min.js') ?>"></script>
<script type="text/javascript">
	// Set new default font family and font color to mimic Bootstrap's default styling
	(Chart.defaults.global.defaultFontFamily = "Nunito"),
	'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = "#858796";

	// Pie Chart Example
	var ctx = document.getElementById("myPieChart");
	var myPieChart = new Chart(ctx, {
		type: "doughnut",
		data: {
			labels: ["Biasa", "Penting", "Segera"],
			datasets: [{
				data: [<?= $data_biasa ?>, <?= $data_penting ?>, <?= $data_segera ?>],
				backgroundColor: ["#4e73df", "#1cc88a", "#36b9cc"],
				hoverBackgroundColor: ["#2e59d9", "#17a673", "#2c9faf"],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			}, ],
		},
		options: {
			maintainAspectRatio: false,
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				borderColor: "#dddfeb",
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				caretPadding: 10,
			},
			legend: {
				display: false,
			},
			cutoutPercentage: 80,
		},
	});
</script>