@include('partials.header')
<div class="container">
    <h1 class="col-md-6 col-md-offset-2">
        รายงาน 30 วันล่าสุด <span class="label label-warning"></span>
    </h1>
    <canvas id="myChart" width="100%"></canvas>
    <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [ {!! implode(",", $graphLabel) !!}],
            datasets: [{
                label: 'ยอดขาย',
                data: [{{ implode(",", $graphData)}}],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
</div>

@include('partials.footer')