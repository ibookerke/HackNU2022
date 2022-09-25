<div>
    <div id="chart_card" style="display: none;">
        <div style="display: flex; flex-wrap: wrap">
            <div style="width: 50%">
                <div>
                    <canvas id="myChart2" width="400" height="400"></canvas>
                </div>
            </div>
            <div style="width: 50%">
                <div>
                    <canvas id="myChart3" width="400" height="400"></canvas>
                </div>
            </div>
            <div style="width: 80%">
                <div style="margin-left: 70px;">
                    <canvas id="myChart1" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div id="chart_missing" class="text-center">
        <h3 class="p-4">Choose cell to show metrics</h3>
    </div>
</div>

@push('scripts')
    <script>
        function generateRandomCharts() {
            console.log('fdsafds')
            let chart1 = [Math.floor(Math.random() * 12), Math.floor(Math.random() * 15), Math.floor(Math.random() * 17)]
            let chart2 = [Math.floor(Math.random() * 12), Math.floor(Math.random() * 15), Math.floor(Math.random() * 17)]
            let chart3 = [Math.floor(Math.random() * 3), Math.floor(Math.random() * 4), Math.floor(Math.random() * 5), Math.floor(Math.random() * 3), Math.floor(Math.random() * 5)]
            showCharts()

            chart1Gen(chart1)
            chart2Gen(chart2)
            chart3Gen(chart3)

        }

        function showCharts() {
            document.getElementById('chart_card').style.display = 'block'
            document.getElementById('chart_missing').style.display = 'none'
        }

        function chart1Gen(data){
            const ctx1 = document.getElementById('myChart1').getContext('2d');
            const myChart1 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: [
                        '12-20y.o.',
                        '20-40y.o.',
                        '40+y.o.'
                    ],
                    datasets: [{
                        label: 'Age distribution',
                        data: data,
                        backgroundColor: [
                            'rgb(217, 223, 171)',
                            'rgb(197, 162, 105)',
                            'rgb(237, 226, 185)',
                            'rgb(180, 217, 209)',
                            'rgb(237, 226, 185)',
                        ],
                        hoverOffset: 4
                    }]
                },
            });
        }

        function chart2Gen(data) {
            const ctx2 = document.getElementById('myChart2').getContext('2d');
            const myChart2 = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: [
                        'Male',
                        'Female',
                        'other'
                    ],
                    datasets: [{
                        label: 'Gender distribution',
                        data: data,
                        backgroundColor: [
                            'rgb(217, 223, 171)',
                            'rgb(197, 162, 105)',
                            'rgb(237, 226, 185)',
                            'rgb(180, 217, 209)',
                            'rgb(237, 226, 185)',
                        ],
                        hoverOffset: 4
                    }]
                },
            });
        }

        function chart3Gen(data){
            const ctx3 = document.getElementById('myChart3').getContext('2d');
            const myChart3 = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: [
                        'Poor',
                        'Low Income',
                        'MiddleClass',
                        'HighIncome',
                        'Rich'
                    ],
                    datasets: [{
                        label: 'Wealth level',
                        data: data,
                        backgroundColor: [
                            'rgb(217, 223, 171)',
                            'rgb(197, 162, 105)',
                            'rgb(237, 226, 185)',
                            'rgb(180, 217, 209)',
                            'rgb(237, 226, 185)',
                        ],
                        hoverOffset: 4
                    }]
                },
            });
        }





    </script>
@endpush
