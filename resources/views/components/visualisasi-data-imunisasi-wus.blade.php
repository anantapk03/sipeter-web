<div>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
    <div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Program Imunisasi Wus - {{\App\Helpers\MonthHelper::getMonth($monthNumber)}} {{$year}}</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="multipleLineImunisasiWus"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    
    {{-- Visualisasi Data Imunisasi Wus --}}
    <script>
        var multipleLineChart = document.getElementById('multipleLineImunisasiWus').getContext('2d');
    
        // variable yang dibutuhkan
        var listSasaran = {!! json_encode($listSasaran) !!}
        var targetSasaran = {!! json_encode($targetSasaran) !!}
        var listCapaian = {!! json_encode($listCapaian) !!}
        
    
        var myMultipleLineChart = new Chart(multipleLineChart, {
            type: 'line',
            data: {
                labels: listSasaran,
                datasets: [{
                    label: "Target Sasaran",
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
                    data: targetSasaran
                },{
                    label: "Capaian Kegiatan",
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
                                return listSasaran[tooltipItem[0].index];
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