<div>
    <!-- He who is contented is rich. - Laozi -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-2 fw-mediumbold">Data Kesehatan Lingkungan</h4>
        <div id="chart-container">
            <canvas id="multipleLineKesling" style="width: 300px; height:300px"></canvas>
        </div>
    </div>

    <script>
        var chartKesling = document.getElementById('multipleLineKesling').getContext('2d');
        var jumlahTarget = {!! json_encode($listTargetKegiatan) !!}
        var jumlahCapaian = {!! json_encode($listJumlahCapaian) !!}
        var activity = {!! json_encode($listKegiatan) !!}
        //console.log(jumlah);
        var myMultipleLineChart = new Chart(chartKesling, {
        type: 'line',
        data: {
            labels: activity,
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
                data: jumlahTarget
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
							return activity[tooltipItem[0].index];
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
</div>