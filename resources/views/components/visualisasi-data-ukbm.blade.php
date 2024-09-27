<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Program Promosi Kesehatan</div>
        </div>
        <div class="card-body">
            <h3>Promosi Kesehatan - Data UKBM yang dibina</h3>
            <div class="chart-container">
                <canvas id="chartUkbm"></canvas>
            </div>
        </div>
    </div>
    {{-- Visualisasi Data UKBM yang dibina Puskesmas --}}
    <script>
        var multipleLineChartUkbm = document.getElementById('chartUkbm').getContext('2d');

        // variable yang dibutuhkan
        var listJenisUkbm = {!! json_encode($listJenisUkbm) !!}
        var targetUkbm = {!! json_encode($listTargetUkbm) !!}
        var listCapaian = {!! json_encode($listCapaianUkbm) !!}

        var myMultipleLineChartUkbm = new Chart(multipleLineChartUkbm, {
            type: 'line',
            data: {
                labels: listJenisUkbm,
                datasets: [{
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
                    data: listCapaian
                }, {
                    label: "Jumlah Target",
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
                    data: targetUkbm
                }]
            },
            options : {
                responsive: true,
                maintainAspectRatio: true,
                legend: {
                    position: 'top',
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
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true, // Start from 0
                            stepSize: 5,      // Set the step size to 5 to ensure multiples of 5
                        }
                    }]
                }
            }
        });
    </script>
</div>