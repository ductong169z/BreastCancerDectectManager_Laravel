@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!--  prediction -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Of Predictions
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['predict'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-stethoscope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- correct -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Correctly Predictions</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $widget['correct'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-medkit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- patient -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('Patients') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['patient'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['user'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- daily overall -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Overall Today</h5>
                </div>
                <div class="card-body mb-2">

                    <h4 class="small font-weight-bold">The Numbers Of Correctly Predictions Today<span
                            class="float-right">{{ $widget['todayCorrect'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar"
                            style="background-color:#76c355;width: {{ $widget['percentTodayCorrect'] }}%" aria-valuenow="40" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">The Numbers Of Confirmed Predictions Today<span
                            class="float-right">{{ $widget['todayConfirm'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar"
                            style="background-color:#fd8c81;width: {{ $widget['percentTodayConfirm'] }}%" aria-valuenow="60" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">The Numbers Of Predictions Today<span
                            class="float-right">{{ $widget['todayPredict'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar " role="progressbar"
                            style="background-color:#ffcc00;width: @if ($widget['todayPredict'] == 0) 0%
                                                                                    @else 100% @endif"
                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            {{-- <!-- monthly weekly --> --}}
            {{-- <div class="card shadow mb-4"> --}}
            {{-- <div class="card-header py-3"> --}}
            {{-- <h6 class="m-0 font-weight-bold text-primary">Projects</h6> --}}
            {{-- </div> --}}
            {{-- <div class="card-body"> --}}
            {{-- <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4> --}}
            {{-- <div class="progress mb-4"> --}}
            {{-- <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div> --}}
            {{-- </div> --}}
            {{-- <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4> --}}
            {{-- <div class="progress mb-4"> --}}
            {{-- <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div> --}}
            {{-- </div> --}}
            {{-- <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4> --}}
            {{-- <div class="progress mb-4"> --}}
            {{-- <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div> --}}
            {{-- </div> --}}
            {{-- <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4> --}}
            {{-- <div class="progress mb-4"> --}}
            {{-- <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> --}}
            {{-- </div> --}}
            {{-- <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4> --}}
            {{-- <div class="progress"> --}}
            {{-- <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}

            <!-- Color System -->
            {{-- <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Primary
                            <div class="text-white-50 small">#4e73df</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Success
                            <div class="text-white-50 small">#1cc88a</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Info
                            <div class="text-white-50 small">#36b9cc</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Warning
                            <div class="text-white-50 small">#f6c23e</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Danger
                            <div class="text-white-50 small">#e74a3b</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Secondary
                            <div class="text-white-50 small">#858796</div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>

        <div class="col-lg-6 mb-4">

            <!-- percentage chart overview -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 ">
                    <h5 class="m-0 font-weight-bold text-primary">Pie Chart of Breast Cancer Ratio Overview </h5>
                </div>
                <div class="card-body">
                    <div id="piechart"></div>
                    {{-- <div class="text-center"> --}}
                    {{-- <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('img/svg/undraw_editable_dywm.svg') }}" alt=""> --}}
                    {{-- </div> --}}
                    {{-- <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p> --}}
                    {{-- <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw →</a> --}}
                </div>
            </div>

            {{-- <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                    CO NEN DE THEM GI O DAY?
                </div>
            </div> --}}

        </div>
    </div>
    <div class="row">
        <!-- Content Column -->
        <div class="col-md-12 text-center">
            <div id="linechart_material" style="height: 500px; margin-bottom: 30px"></div>
        </div>
    </div>





@endsection
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Day', 'Correct Predictions', 'Total Predictions'],
            {!! $data !!}
        ]);

        var options = {
            title: 'Number of predictions of the last 7 days',
            curveType: 'none',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('linechart_material'));

        chart.draw(data, options);
    }
</script>
{{-- percent cancers pie chart --}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Kind', 'Percent'],
            {!! $percent !!}
        ]);

        var options = {
            //title: 'Rate of diseases',
            chartArea:{left:50,top:25,width:'80%',height:'80%'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>


