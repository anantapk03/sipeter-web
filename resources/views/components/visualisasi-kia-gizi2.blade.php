<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
    
	<div class="card">
		<div class="card-header">
			<div class="card-title">Program KIA & Kesehatan Gizi - {{\App\Helpers\MonthHelper::getMonth($monthNumber)}} - {{$year}}</div>
		</div>
		<div class="card-body">
			<div class="chart-container">
				<canvas id="multipleChartKiaGizi"></canvas>
			</div>
		</div>
	</div>

	<script>
		var labels = {!! json_encode($listProgram) !!};
		var listTotalKegiatanInProgram = {!! json_encode($listTotalKegiatanInProgram) !!};
		var listTotalKegiatanAchieveTarget = {!! json_encode($listTotalKegiatanAchieveTarget) !!};
		var listTotalKegiatanInReportThisMonth = {!! json_encode($listTotalKegiatanInReportThisMonth) !!};
		var multipleChartKiaGizi = document.getElementById('multipleChartKiaGizi').getContext('2d');
		var mymultipleChartKiaGizi = new Chart(multipleChartKiaGizi, {
			type: 'line',
			data: {
				labels: labels,
				datasets: [{
					label: "Total Kegiatan",
					borderColor: "#1d7af3",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#1d7af3",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: listTotalKegiatanInProgram
				},{
					label: "Total Kegiatan Yang Dilaksanakan",
					borderColor: "#59d05d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#59d05d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: listTotalKegiatanInReportThisMonth
				}, {
					label: "Total Kegiatan Yang Mencapai Target",
					borderColor: "#f3545d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#f3545d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: listTotalKegiatanAchieveTarget,
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'top',
				},
				scales: {
					xAxes: [{
						ticks: {
							callback: function(value, index, values) {
								return value.length > 10 ? value.substr(0, 10) + '...' : value;
							}
						}
					}],
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				},
				tooltips: {
					callbacks: {
						title: function(tooltipItem, data) {
							// Mengambil label dari array labels berdasarkan indeks
							return labels[tooltipItem[0].index];
						},
						label: function(tooltipItem, data) {
							// Mengambil label dataset dan nilai
							var datasetLabel = data.datasets[tooltipItem.datasetIndex].label; // Nama dataset
							var value = tooltipItem.yLabel; // Nilai
							return datasetLabel + ': ' + value; // Format: "Capaian: 80" atau "Target: 80"
						}
					},
					bodySpacing: 4,
					mode: "nearest",
					intersect: 0,
					position: "nearest",
					xPadding: 10,
					yPadding: 10,
					caretPadding: 10
				},
				layout: {
					padding: {left:15, right:15, top:15, bottom:15}
				}
			}
		});
	</script>
</div>