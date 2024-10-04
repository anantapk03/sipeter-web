<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
    <div class="card">
		<div class="card-header">
			<div class="card-title">Program Pengendalian Penyakit Menular - {{\App\Helpers\MonthHelper::getMonth($monthNumber)}} {{$year}}</div>
		</div>
		<div class="card-body">
			<div class="chart-container">
				<canvas id="multipleLineChartP2Menular"></canvas>
			</div>
		</div>
	</div>

	<script>
		var listNamaProgramP2Menular = {!! json_encode($listNamaProgramP2Menular) !!};
        var listTotalKegiatanForEachProgram = {!! json_encode($listTotalKegiatanForEachProgram) !!};
        var listTotalCapaianKegiatan = {!! json_encode($listTotalCapaianKegiatan) !!};
        var listTotalKegiatanBelumMencapaiTarget = {!! json_encode($listTotalKegiatanBelumMencapaiTarget) !!};
		var multipleLineChartP2Menular = document.getElementById('multipleLineChartP2Menular').getContext('2d');
		var mymultipleLineChartP2Menular = new Chart(multipleLineChartP2Menular, {
			type: 'line',
			data: {
				labels: listNamaProgramP2Menular,
				datasets: [{
					label: "Jumlah Kegiatan",
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
					data: listTotalKegiatanForEachProgram
				},
                {
					label: "Total Kegiatan Yang Telaksana",
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
					data: listTotalCapaianKegiatan
				},
                {
					label: "Total Kegiatan Belum Mencapai Target",
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
					data: listTotalKegiatanBelumMencapaiTarget
				}
                
                ]
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
							return listNamaProgramP2Menular[tooltipItem[0].index];
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