<div>
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Radar Chart Total Kegiatan Yang Sudah Dilaporkan -  {{\App\Helpers\MonthHelper::getMonth($currentMonth)}} - {{$currentYear}}</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="kiaGiziRadarChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    var labelKiaGiziRadarChart = {!! $labelProgramKiaGiziRadarChart !!};
    var datasetsKiaGiziRadarChart = {!! $labelDatasetsKiaGiziRadarChart !!};
	var kiaGiziRadarChart = document.getElementById('kiaGiziRadarChart').getContext('2d');
    var mykiaGiziRadarChart = new Chart(kiaGiziRadarChart, {
			type: 'radar',
			data: {
				labels: labelKiaGiziRadarChart,
				datasets: datasetsKiaGiziRadarChart,
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				}
			}
		});

</script>