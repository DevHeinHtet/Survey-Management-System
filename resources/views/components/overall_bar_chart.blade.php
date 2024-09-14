<div class="h-full">
    @if (sizeof($montlyData))
        <canvas id="barChart"></canvas>
    @else
        <span>No Data Found</span>
    @endif
</div>

<script type="text/javascript">
    const barLabels = ["Jan","Feb","March","Apri","Mays","Jun","July","Aug","Sep","Oct","Nov","Dec"];
    const barData = {
    labels: barLabels,
    datasets: [
    {
        label: 'Accepted Data',
        data: [
            {{ $montlyData[1][1] }},
            {{ $montlyData[1][2] }},
            {{ $montlyData[1][3] }},
            {{ $montlyData[1][4] }},
            {{ $montlyData[1][5] }},
            {{ $montlyData[1][6] }},
            {{ $montlyData[1][7] }},
            {{ $montlyData[1][8] }},
            {{ $montlyData[1][9] }},
            {{ $montlyData[1][10] }},
            {{ $montlyData[1][11] }},
            {{ $montlyData[1][12] }},
        ],
        backgroundColor: "rgba(0,255,0,1)",
        fill: false,
        borderColor: '#32CD32',
        tension: 0.1
    },
    {
        label: 'Rejected Data',
        data: [
            {{ $montlyData[2][1] }},
            {{ $montlyData[2][2] }},
            {{ $montlyData[2][3] }},
            {{ $montlyData[2][4] }},
            {{ $montlyData[2][5] }},
            {{ $montlyData[2][6] }},
            {{ $montlyData[2][7] }},
            {{ $montlyData[2][8] }},
            {{ $montlyData[2][9] }},
            {{ $montlyData[2][10] }},
            {{ $montlyData[2][11] }},
            {{ $montlyData[2][12] }},
        ],
        backgroundColor: "rgba(255,0,0,1)",
        fill: false,
        borderColor: '#FF0000',
        tension: 0.1
    }]
    };

    const barConfig = {
        type: 'bar',
        data: barData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    var barChart = new Chart(
        document.getElementById("barChart"),
        barConfig
    );
</script>