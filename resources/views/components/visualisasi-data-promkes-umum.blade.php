<div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Program Promosi Kesehatan</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="multipleLinePromkesUmum"></canvas>
            </div>
        </div>
    </div>
</div>


{{-- Visualisasi Data Promosi Kesehatan Umum Desa --}}
<script>
    var multipleLineChart = document.getElementById('multipleLinePromkesUmum').getContext('2d');

    // variable yang dibutuhkan
    var kegiatan = {!! json_encode($listKegiatan) !!}
    var targetKegiatan = {!! json_encode($targetKegiatan) !!}
    var jumlahCapaian = {!! json_encode($jumlahCapaian) !!}
    var jumlahDesa = {!! json_encode($jumlahDesa) !!}

    var myMultipleLineChart = new Chart(multipleLineChart, {
        type: 'line',
        data: {
            labels: kegiatan,
            datasets: [{
                label: "Jumlah Target",
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
                data: targetKegiatan
            },{
                label: "Jumlah Capaian",
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
                data: jumlahCapaian
            }, {
                label: "Jumlah Desa Terlaksana",
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
                data: jumlahDesa
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
							return kegiatan[tooltipItem[0].index];
						},
						label: function(tooltipItem, data) {
							// Mengambil label dataset dan nilai
							var datasetLabel = data.datasets[tooltipItem.datasetIndex].label; // Nama dataset
							var value = tooltipItem.yLabel; // Nilai
							return datasetLabel + ': ' + value; // Format: "Capaian: 80" atau "Target: 80"
						}
					},
                bodySpacing: 4,
                mode:"nearest",
                intersect: 0,
                position:"nearest",
                xPadding:10,
                yPadding:10,
                caretPadding:10
            },
            layout:{
                padding:{left:15,right:15,top:15,bottom:15}
            }
        }
    });
</script>