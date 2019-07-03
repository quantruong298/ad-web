
<canvas id="lineChart"></canvas>
<script>
    //line
    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
        type: 'line',
        data: {
            labels: [
                @foreach($report as $rp)
                    "{{$rp->datetime}}",
                @endforeach
            ],
            datasets: [{
                label: "Views",
                data: [
                    @foreach($report as $rp)
                        "{{$rp->views}}",
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(105, 0, 132, .2)',
                ],
                borderColor: [
                    'rgba(200, 99, 132, .7)',
                ],
                borderWidth: 2
            },
                {
                    label: "Clicks",
                    data: [
                        @foreach($report as $rp)
                            "{{$rp->clicks}}",
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(0, 137, 132, .2)',
                    ],
                    borderColor: [
                        'rgba(0, 10, 130, .7)',
                    ],
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true
        }
    });
</script>