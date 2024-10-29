<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Percentage Users In Divisi</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="statisticUsersPieChart" style="width: 50%; height: 50%"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    function generateRandomColors(numColors) {
        let colors = [];
        for (let i = 0; i < numColors; i++) {
            // Generate warna heksadesimal acak
            let color = `#${Math.floor(Math.random() * 16777215).toString(16)}`;
            colors.push(color);
        }
        return colors;
    }   
    labelsDivisiPieChart = {!! json_encode($labelsDivisiPieChart) !!};
    totalsUsersInDivisiPieChart = {!! json_encode($totalsUsersInDivisiPieChart) !!};
    statisticUsersPieChart = document.getElementById('statisticUsersPieChart').getContext('2d');
    var randomColors = generateRandomColors(labelsDivisiPieChart.length);
    var mystatisticUsersPieChart = new Chart(statisticUsersPieChart, {
			type: 'pie',
			data: {
				datasets: [{
					data: totalsUsersInDivisiPieChart,
					backgroundColor :randomColors,
					borderWidth: 0
				}],
				labels: labelsDivisiPieChart
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position : 'bottom',
					labels : {
						fontColor: 'rgb(154, 154, 154)',
						fontSize: 11,
						usePointStyle : true,
						padding: 20
					}
				},
				pieceLabel: {
					render: 'percentage',
					fontColor: 'white',
					fontSize: 14,
				},
				tooltips: false,
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		})

</script>