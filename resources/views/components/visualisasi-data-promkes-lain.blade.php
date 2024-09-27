<div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Program Promosi Kesehatan</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="multipleLinePromkesLain"></canvas>
            </div>
        </div>
    </div>
</div>


{{-- Visualisasi Data Promosi Kesehatan --}}
<script>
    var multipleLineChart = document.getElementById('multipleLinePromkesLain').getContext('2d');

    // variable yang dibutuhkan
    var listProgram = {!! json_encode($listProgramPromkes) !!}
    var totalKegiatan = {!! json_encode($totalKegiatan) !!}

    var myMultipleLineChart = new Chart(multipleLineChart, {
        type: 'line',
        data: {
            labels: listProgram,
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
                data: totalKegiatan
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