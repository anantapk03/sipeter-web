<div>
    <!-- Well begun is half done. - Aristotle -->
    <div class="card">
		<div class="card-header">
			<div class="card-title">Statistic Users</div>
		</div>
		<div class="card-body">
			<div class="chart-container">
				<canvas id="visualizationStatisticUsersBarCharts"></canvas>
			</div>
		</div>
    </div>
    
</div>

<script>
    visualizationStatisticUsersBarCharts = document.getElementById('visualizationStatisticUsersBarCharts').getContext('2d');
    labelsDivisi = {!! json_encode($labelsDivisi) !!};
    totalsUsersInDivisi = {!! json_encode($totalsUsersInDivisi) !!};
	// Menggunakan slice untuk menampilkan hanya beberapa huruf pertama dari label
	var shortenedLabels = labelsDivisi.map(label => label.length > 5 ? label.slice(0, 5) + '...' : label);
    
    var myvisualizationStatisticUsersBarCharts = new Chart(visualizationStatisticUsersBarCharts, {
        type: 'bar',
        data: {
            labels: shortenedLabels,
            datasets: [{
                label: "Users",
                backgroundColor: 'rgb(23, 125, 255)',
                borderColor: 'rgb(23, 125, 255)',
                data: totalsUsersInDivisi,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    title: function(tooltipItem, data) {
                        // Menampilkan label lengkap pada tooltip
                        return labelsDivisi[tooltipItem[0].index];
                    }
                }
            }
        }
    });
</script>