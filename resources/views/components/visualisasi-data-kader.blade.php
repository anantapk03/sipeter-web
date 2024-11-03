<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Perbandingan Jumlah Kader</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="multipleBarChart" style="width: 50%; height: 50%"></canvas>
            </div>
        </div>
    </div>
</div>
{{-- JS --}}
<script>
    var listJenisUkbm = {!! json_encode($jenisUkbm) !!}
	var listJumlahKader = {!! json_encode($listJumlahKader) !!}
	var jumlahKaderDilatih = {!! json_encode($jumlahKaderDilatih) !!}

	var multipleBarChart = document.getElementById('multipleBarChart').getContext('2d');
    var kaderChart = new Chart(multipleBarChart, {
		type: 'bar',
			data: {
				labels: listJenisUkbm,
				datasets : [{
					label: "Jumlah Kader",
					backgroundColor: '#3bd700',
					borderColor: '#3bd700',
					data: listJumlahKader,
				},{
					label: "Jumlah Kader yang dilatih",
					backgroundColor: '#007aea',
					borderColor: '#007aea',
					data: jumlahKaderDilatih,
				}],
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position : 'bottom'
				},
				title: {
					display: true,
					text: 'Traffic Stats'
				},
				tooltips: {
					callbacks: {
						title: function(tooltipItem, data) {
							// Mengambil label dari array labels berdasarkan indeks
							return listJenisUkbm[tooltipItem[0].index];
						},
						label: function(tooltipItem, data) {
							// Mengambil label dataset dan nilai
							var datasetLabel = data.datasets[tooltipItem.datasetIndex].label; // Nama dataset
							var value = tooltipItem.yLabel; // Nilai
							return datasetLabel + ': ' + value; // Format: "Capaian: 80" atau "Target: 80"
						}
					},
					mode: 'index',
					intersect: false
				},
				responsive: true,
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
				}
			}
		})

</script>