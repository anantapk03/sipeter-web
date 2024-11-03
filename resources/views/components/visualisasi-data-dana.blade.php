<div>
    <!-- Be present above all else. - Naval Ravikant -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Persentase Sumber Dana</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="persentaseChartDana" style="width: 50%; height: 50%"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // generate random color
    function generateRandomColors(numColors) {
        let colors = [];
        for (let i = 0; i < numColors; i++) {
            // Generate warna heksadesimal acak
            let color = `#${Math.floor(Math.random() * 16777215).toString(16)}`;
            colors.push(color);
        }
        return colors;
    }   

    var sumberDana = {!! json_encode($listPembiayaan) !!}
    var persentaseDana = {!! json_encode($persentasePembiayaan) !!}
    var randomColors = generateRandomColors(sumberDana.length);

	var persentasePieChart = document.getElementById('persentaseChartDana').getContext('2d');
    var myPieChart = new Chart(persentasePieChart, {
			type: 'pie',
			data: {
				datasets: [{
					data: persentaseDana,
					backgroundColor : randomColors,
					borderWidth: 0
				}],
				labels: sumberDana
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