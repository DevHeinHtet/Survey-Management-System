<canvas id="rejectedChart"></canvas>
<script type="text/javascript">
    const rejectedData = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };
    const rejectedChartConfig = {
        type: 'doughnut',
        data: rejectedData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                display: false
                },
            },
        }
    };
    var rejectedChart = new Chart(
        document.getElementById("rejectedChart"),
        rejectedChartConfig
    );
</script>