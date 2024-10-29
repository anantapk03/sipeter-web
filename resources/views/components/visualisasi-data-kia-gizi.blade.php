<div>
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->

	<div class="card">
		<div class="card-header">
			<div class="card-title">Program Usaha Kesehatan Sekolah - {{\App\Helpers\MonthHelper::getMonth($monthNumber)}} - {{$year}}</div>
		</div>
		<div class="card-body">
			<div class="chart-container">
				<canvas id="multipleLineChartUKS"></canvas>
			</div>
		</div>
	</div>

	<script>
		var labelsUKS = {!! json_encode($listKegiatan) !!};
		var listTotalTarget = {!! json_encode($listTotalTarget) !!};
		var listTotalCapaian = {!! json_encode($listTotalCapaian) !!};
		var listTotalKelasKegiatan = {!! json_encode($listTotalKelasKegiatan) !!};
		var multipleLineChartUKS = document.getElementById('multipleLineChartUKS').getContext('2d');
		var mymultipleLineChartUKS = new Chart(multipleLineChartUKS, {
			type: 'line',
			data: {
				labels: labelsUKS,
				datasets: [{
					label: "Capaian",
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
					data: listTotalCapaian
				},{
					label: "Target",
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
					data: listTotalTarget
				}, {
					label: "Jumlah Kelas",
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
					data: listTotalKelasKegiatan
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
							return labelsUKS[tooltipItem[0].index];
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