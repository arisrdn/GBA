@extends('layouts.admin-main')

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="section">
        {{-- <div class="section-header">
            <h1>Dashboard</h1>
            @include('layouts.partials.breadcums')
        </div> --}}
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title mt-3">

                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">24</div>
                                <div class="card-stats-item-label">Request Join</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">12</div>
                                <div class="card-stats-item-label">Request Leave</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">23</div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-user-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total User</h4>
                        </div>
                        <div class="card-body">
                            59
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="balance-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-warning bg-warning">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Group</h4>
                        </div>
                        <div class="card-body">
                            123
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="sales-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sales</h4>
                        </div>
                        <div class="card-body">
                            @can('Admin')
                                "write something which only admin see"
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.flash-message')
        {{-- <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Admin</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>News</h4>
                        </div>
                        <div class="card-body">
                            42
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Reports</h4>
                        </div>
                        <div class="card-body">
                            1,201
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>


                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Anggota Grup</h4>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="myChart" height="696" style="display: block; height: 348px; width: 662px;"
                            width="1324" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="far fa-question-circle"></i>
                        </div>
                        <h4>14</h4>
                        <div class="card-description">Member Request Join</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tickets-list">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table-bordered table">
                                        <tbody>
                                            <tr>
                                                <th>No</th>
                                                <th>nama</th>
                                                <th>group</th>
                                                <th>request</th>
                                                <th>action</th>
                                            </tr>


                                            @foreach ($member as $dat)
                                                <tr>
                                                    <td>
                                                        {{ $dat->id }}</td>
                                                    <td>{{ $dat->user->name }}</td>
                                                    <td>{{ $dat->group->name }}</td>
                                                    <td>{{ $dat->created_at }}</td>
                                                    <td>
                                                        <form method="post" action="{{ url('/approve/join') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" id="custId" name="id"
                                                                value="{{ $dat->id }} ">
                                                            <button type="submit" class="btn btn-primary">approve</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <input type="hidden" id="custId" name="custId" value="3487">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <a href="{{ route('join') }}" class="ticket-item ticket-more">
                                View All <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>test approve</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table-bordered table">
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>nama</th>
                                        <th>group</th>
                                        <th>request</th>
                                        <th>action</th>
                                    </tr>


                                    @foreach ($member as $dat)
                                        <tr>
                                            <td>
                                                {{ $dat->id }}</td>
                                            <td>{{ $dat->user->name }}</td>
                                            <td>{{ $dat->group->name }}</td>
                                            <td>{{ $dat->created_at }}</td>
                                            <td>
                                                <form method="post" action="{{ url('/approve/join') }}"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" id="custId" name="id"
                                                        value="{{ $dat->id }} ">
                                                    <button type="submit" class="btn btn-primary">approve</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <input type="hidden" id="custId" name="custId" value="3487">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-4">
                <div class="card gradient-bottom">
                    <div class="card-header">
                        <h4>Grup Terbaikr</h4>
                        {{-- <div class="card-header-action dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Select Period</li>
                                <li><a href="#" class="dropdown-item">Today</a></li>
                                <li><a href="#" class="dropdown-item">Week</a></li>
                                <li><a href="#" class="dropdown-item active">Month</a></li>
                                <li><a href="#" class="dropdown-item">This Year</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="card-body" id="top-5-scroll" tabindex="2"
                        style="height: 315px; overflow: hidden; outline: none;">
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="../assets/img/products/product-3-50.png"
                                    alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">86 Sales</div>
                                    </div>
                                    <div class="media-title">oPhone S9 Limited</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="64%"
                                                style="width: 64%;"></div>
                                            <div class="budget-price-label">$68,714</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="43%"
                                                style="width: 43%;">
                                            </div>
                                            <div class="budget-price-label">$38,700</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="../assets/img/products/product-4-50.png"
                                    alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">67 Sales</div>
                                    </div>
                                    <div class="media-title">iBook Pro 2018</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="84%"
                                                style="width: 84%;"></div>
                                            <div class="budget-price-label">$107,133</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="60%"
                                                style="width: 60%;"></div>
                                            <div class="budget-price-label">$91,455</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="../assets/img/products/product-1-50.png"
                                    alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">63 Sales</div>
                                    </div>
                                    <div class="media-title">Headphone Blitz</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="34%"
                                                style="width: 34%;"></div>
                                            <div class="budget-price-label">$3,717</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="28%"
                                                style="width: 28%;"></div>
                                            <div class="budget-price-label">$2,835</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="../assets/img/products/product-3-50.png"
                                    alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">28 Sales</div>
                                    </div>
                                    <div class="media-title">oPhone X Lite</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="45%"
                                                style="width: 45%;"></div>
                                            <div class="budget-price-label">$13,972</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="30%"
                                                style="width: 30%;"></div>
                                            <div class="budget-price-label">$9,660</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="../assets/img/products/product-5-50.png"
                                    alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">19 Sales</div>
                                    </div>
                                    <div class="media-title">Old Camera</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="35%"
                                                style="width: 35%;"></div>
                                            <div class="budget-price-label">$7,391</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="28%"
                                                style="width: 28%;"></div>
                                            <div class="budget-price-label">$5,472</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center pt-3">
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-primary" data-width="20" style="width: 20px;"></div>
                            <div class="budget-price-label">Selling Price</div>
                        </div>
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-danger" data-width="20" style="width: 20px;"></div>
                            <div class="budget-price-label">Budget Price</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Test leave group</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table-bordered table">
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>nama</th>
                                        <th>group </th>
                                        <th>reason </th>
                                        <th>request leave</th>
                                        <th>action</th>
                                    </tr>


                                    @foreach ($member2 as $dat)
                                        <tr>
                                            <td>
                                                {{ $dat->id }}</td>
                                            <td>{{ $dat->user->name }}</td>
                                            <td>{{ $dat->group->name }}</td>
                                            <td>{{ $dat->note }}</td>
                                            <td>{{ $dat->updated_at }}</td>
                                            <td>
                                                <form method="post" action="{{ url('/approve/leave') }}"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" id="custId" name="id"
                                                        value="{{ $dat->id }} ">
                                                    <button type="submit" class="btn btn-danger">approve</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <input type="hidden" id="custId" name="custId" value="3487">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="section">
        <div class="section-header">
            <h1>Chart.JS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Modules</a></div>
                <div class="breadcrumb-item">Chart.js</div>
            </div>
        </div>


        {{-- <div class="section-body">
            <h2 class="section-title">Chart.js</h2>
            <p class="section-lead">
                We use 'Chart.JS' made by @chartjs. You can check the full documentation <a
                    href="http://www.chartjs.org/">here</a>.
            </p>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Line Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Bar Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Doughnut Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pie Chart</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
@section('plugin_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"
        integrity="sha512-oaUGh3C8smdaT0kMeyQ7xS1UY60lko23ZRSnRljkh2cbB7GJHZjqe3novnhSNc+Qj21dwBE5dFBqhcUrFc9xIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var ctx1 = document.getElementById("balance-chart");

        var app = <?php echo json_encode($datagroup); ?>;
        var lable = [];
        var datagroup = [];
        var color = [];
        app.forEach(element => {
            lable.push(element.name)
            datagroup.push(element.total_member_count)
            color.push('rgba(54, 162, 235, 1)')
        });
        console.log(app);

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: lable,
                datasets: [{
                    label: '# of Votes',
                    data: datagroup,
                    backgroundColor: color
                }]
            },
            options: {
                legend: {
                    display: false,
                },
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


    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyANUovdt1apORq-aiSOARqsnkt4s2Q61Uo",
            authDomain: "gabapp-2d12b.firebaseapp.com",
            projectId: "gabapp-2d12b",
            storageBucket: "gabapp-2d12b.appspot.com",
            messagingSenderId: "55539172106",
            appId: "1:55539172106:web:2dc032dbb01d43f850b0f3",
            measurementId: "G-3X0NLCGS86"
        };
        // Add the public key generated from the console here.
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        messaging.getToken().then((currentToken) => {
            if (currentToken) {
                // Send the token to your server and update the UI if necessary
                sendToken(currentToken);
                console.log('ok');

                // ...
            } else {
                // Show permission request UI
                console.log('No registration token available. Request permission to generate one.');
                // ...
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
            // ...
        });

        function sendToken(token) {
            axios.post('{{ route('store.token') }}', {
                    token
                })
                .then(function(response) {
                    console.log(response);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>
@endsection
@endsection
