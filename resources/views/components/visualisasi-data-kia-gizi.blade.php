<div>
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Program Usaha Kesehatan Sekolah - {{\App\Helpers\MonthHelper::getMonth($monthNumber)}}</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="multipleBarUKS"></canvas>
            </div>
        </div>
    </div>


    <script>
		// USAHA KESEHATAN Sekolah
		var labels = {!! json_encode($listKegiatan) !!};
		var listTotalTarget = {!! json_encode($listTotalTarget) !!};
		var listTotalCapaian = {!! json_encode($listTotalCapaian) !!}

        var multipleBarUKS = document.getElementById('multipleBarUKS').getContext('2d');
        var mymultipleBarUKS = new Chart(multipleBarUKS, {
			type: 'bar',
			data: {
				labels: labels,
				datasets : [
                {
					label: "Jumlah Kelas",
					backgroundColor: '#59d05d',
					borderColor: '#59d05d',
					data: [95, 100, 112, 101, 144, 159, 178, 156, 188, 190, 210, 245],
				},{
					label: "Capaian Program",
					backgroundColor: '#fdaf4b',
					borderColor: '#fdaf4b',
					data: listTotalCapaian,
				}, {
					label: "Jumlah Target",
					backgroundColor: '#177dff',
					borderColor: '#177dff',
					data: listTotalTarget,
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
					mode: 'index',
					intersect: false
				},
				responsive: true,
				scales: {
					xAxes: [{
						stacked: true,
					}],
					yAxes: [{
						stacked: true
					}]
				}
			}
		});


    </script>
</div>