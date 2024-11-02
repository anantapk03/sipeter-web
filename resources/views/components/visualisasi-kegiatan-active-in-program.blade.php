<div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Statistic Data Total Kegiatan Pada Setiap Program</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="barChartTotalKegiatanInProgramKiaGizi"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    var listLabelProgramKiaGizi = {!! json_encode($listLabelProgram) !!};
    var shortenedLablesKiaGizi = listLabelProgramKiaGizi.map(labelsKiaGizi=>labelsKiaGizi.length > 5 ? labelsKiaGizi.slice(0, 5)+'...':labelsKiaGizi)
    var listTotalKegiatanActiveKiaGizi = {!! json_encode($listTotalKegiatanActive) !!};
    barChartTotalKegiatanInProgramKiaGizi = document.getElementById('barChartTotalKegiatanInProgramKiaGizi').getContext('2d');


    var myBarChartTotalKegiatanInProgramKiaGizi = new Chart(barChartTotalKegiatanInProgramKiaGizi, {
			type: 'bar',
			data: {
				labels: shortenedLablesKiaGizi,
				datasets : [{
					label: "Total Kegiatan In Program",
					backgroundColor: 'rgb(23, 125, 255)',
					borderColor: 'rgb(23, 125, 255)',
					data: listTotalKegiatanActiveKiaGizi,
				}],
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},
                tooltips:{
                    callbacks:{
                        title: function(tooltipItem, data){
                            return listLabelProgramKiaGizi[tooltipItem[0].index];
                        }
                    }
                }
			}
		});

</script>