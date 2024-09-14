@if ($dashboard->whereMonth('date',$monthNo)->sum('count') > 0)
    <canvas id="yearChart"></canvas>
@else
    <span>No Data Found</span>
@endif
<script type="text/javascript">
    const data = {
        labels: [
            'Pending',
            'Accepted',
            'Rejected'
        ],
        datasets: [{
            label: 'Survey Data Count',
            data: [
                {{ $pieData[0] }},
                {{ $pieData[1] }},
                {{ $pieData[2] }}
            ],
            backgroundColor: [
            '#EE82EE',
            '#32CD32',
            '#FF0000'
            ],
            hoverOffset: 8
        }]
    };
    const configRadar = {
        type: "doughnut",
        data: data,
        options: {
            plugins: {
                legend: {
                display: false
                },
            },
            layout: {
                padding: {
                    left:10,
                    right:10,
                }
            },
        }
    };
    var radar = new Chart(
        document.getElementById("yearChart"),
        configRadar
    );
</script>