@extends('main')

@section('content')
<div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-3">
            <h2>Dashboard Auto 2000</h2>
            <small>Anda punya 42 pesan dan 6 notifikasi.</small>
            <ul class="list-group clear-list m-t">
                <li class="list-group-item fist-item">
                    <span class="pull-right">
                        09:00 pm
                    </span>
                    <span class="label label-success">1</span> Tolong hubungi saya
                </li>
                <li class="list-group-item">
                    <span class="pull-right">
                        10:16 am
                    </span>
                    <span class="label label-info">2</span> Tanda tangani sebuah kontrak
                </li>
                <li class="list-group-item">
                    <span class="pull-right">
                        08:22 pm
                    </span>
                    <span class="label label-primary">3</span> Buka toko baru
                </li>
                <li class="list-group-item">
                    <span class="pull-right">
                        11:06 pm
                    </span>
                    <span class="label label-default">4</span> Telpon kembali Sarah
                </li>
                <li class="list-group-item">
                    <span class="pull-right">
                        12:00 am
                    </span>
                    <span class="label label-primary">5</span> Tulis surat ke Sarah
                </li>
            </ul>
        </div>
        <div class="col-sm-6">
            <div class="flot-chart dashboard-chart">
                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
            </div>
            <div class="row text-left">
                <div class="col-xs-4">
                    <div class=" m-l-md">
                    <span class="h4 font-bold m-t block">$ 406,100</span>
                    <small class="text-muted m-b block">Laporan Penjualan & Pemasaran</small>
                    </div>
                </div>
                <div class="col-xs-4">
                    <span class="h4 font-bold m-t block">$ 150,401</span>
                    <small class="text-muted m-b block">Pendapatan Penjualan Tahunan</small>
                </div>
                <div class="col-xs-4">
                    <span class="h4 font-bold m-t block">$ 16,822</span>
                    <small class="text-muted m-b block">Margin pendapatan setengah tahun</small>
                </div>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="statistic-box">
            <h4>
                Progres Proyek Beta
            </h4>
            <p>
                Anda memiliki dua proyek yang belum selesai.
            </p>
                <div class="row text-center">
                    <div class="col-lg-6">
                        <canvas id="polarChart" width="80" height="80"></canvas>
                        <h5 >Kolter</h5>
                    </div>
                    <div class="col-lg-6">
                        <canvas id="doughnutChart" width="78" height="78"></canvas>
                        <h5 >Maxtor</h5>
                    </div>
                </div>
                <div class="m-t">
                    <small>Progres proyek Maktor lebih banyak daripada progres proyek Kolter.</small>
                </div>

            </div>
        </div>

</div>

@endsection
@section('extra_script')
<script type="text/javascript">
    $(document).ready(function(){

        var data1 = [
            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = [
            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
            data1, data2
        ],
                {
                    series: {
                        lines: {
                            show: false,
                            fill: true
                        },
                        splines: {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        points: {
                            radius: 0,
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        tickColor: "#d5d5d5",
                        borderWidth: 1,
                        color: '#d5d5d5'
                    },
                    colors: ["#1ab394", "#1C84C6"],
                    xaxis:{
                    },
                    yaxis: {
                        ticks: 4
                    },
                    tooltip: false
                }
        );

        var doughnutData = [
            {
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 50,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 100,
                color: "#A4CEE8",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var doughnutOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            percentageInnerCutout: 45, // This is 0 for Pie charts
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false
        };

        var ctx = document.getElementById("doughnutChart").getContext("2d");
        var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

        var polarData = [
            {
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 140,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 200,
                color: "#A4CEE8",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var polarOptions = {
            scaleShowLabelBackdrop: true,
            scaleBackdropColor: "rgba(255,255,255,0.75)",
            scaleBeginAtZero: true,
            scaleBackdropPaddingY: 1,
            scaleBackdropPaddingX: 1,
            scaleShowLine: true,
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false
        };
        var ctx = document.getElementById("polarChart").getContext("2d");
        var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);
    });
</script>
@endsection