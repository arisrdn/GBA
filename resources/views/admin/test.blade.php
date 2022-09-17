{{-- @extends('layouts.admin-main')

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <button onclick="startFCM()" class="btn btn-danger btn-flat">Allow notification
                    </button>
                    <div class="card mt-3">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="{{ route('send.web-notification') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Message Title</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="form-group">
                                    <label>Message Body</label>
                                    <textarea class="form-control" name="body"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="" class="btn btn-danger btn-flat">Allow notification

        </button>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Who's Online?</h4>
                    </div>
                    <div class="card-body">



                        @forelse($notifications as $notification)
                            <div class="alert alert-success" role="alert">
                                [{{ $notification->created_at }}] User {{ $notification->data['name'] }}
                                {{-- ({{ $notification->data['email'] }}) --}}
has just registered.
<a href="#" class="mark-as-read float-right" data-id="{{ $notification->id }}">
    Mark as read
</a>
</div>

@if ($loop->last)
    <a href="#" id="mark-all">
        Mark all as read
    </a>
@endif
@empty
    There are no new notifications
    @endforelse
    <ul class="list-unstyled list-unstyled-border">
        @foreach ($data1 as $user)
            <li class="media">
                <img alt="image" class="rounded-circle mr-3" width="50" src="../assets/img/avatar/avatar-1.png">
                <div class="media-body">
                    <div class="font-weight-bold mt-0 mb-1">{{ $user->name }}</div>
                    <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i>
                        Online
                    </div>
                </div>
            </li>
        @endforeach

        <li class="media">
            <img alt="image" class="rounded-circle mr-3" width="50" src="../assets/img/avatar/avatar-2.png">
            <div class="media-body">
                <div class="font-weight-bold mt-0 mb-1">Bagus Dwi Cahya</div>
                <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Offline
                </div>
            </div>
        </li>
        <li class="media">
            <img alt="image" class="rounded-circle mr-3" width="50" src="../assets/img/avatar/avatar-3.png">
            <div class="media-body">
                <div class="font-weight-bold mt-0 mb-1">Wildan Ahdian</div>
                <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i>
                    Online
                </div>
            </div>
        </li>
        <li class="media">
            <img alt="image" class="rounded-circle mr-3" width="50" src="../assets/img/avatar/avatar-4.png">
            <div class="media-body">
                <div class="font-weight-bold mt-0 mb-1">Rizal Fakhri</div>
                <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i>
                    Online
                </div>
            </div>
        </li>
    </ul>
    </div>
    </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="card chat-box card-success" id="mychatbox2">
            <div class="card-header">

                <h4><i class="fas fa-circle text-success mr-2" title="Online" data-toggle="tooltip"></i> test
                    chat
                </h4>
            </div>

            {{-- <div class="card-body chat-content">
                </div> --}}
            <div class="card-body chat-content cartData" tabindex="2" style="overflow: hidden; outline: none;">
                <div class="chat-item chat-left" style=""><img src="../assets/img/avatar/avatar-5.png">
                    <div class="chat-details">
                        <div class="chat-text">Wake up!</div>
                        <div class="chat-time">07:01</div>
                    </div>
                </div>
                <div class="chat-item chat-right" style=""><img src="../assets/img/avatar/avatar-2.png">
                    <div class="chat-details">
                        <div class="chat-text">Yes, already</div>
                        <div class="chat-time">07:01</div>
                    </div>
                </div>
                <div class="chat-item chat-left" style=""><img src="../assets/img/avatar/avatar-5.png">
                    <div class="chat-details">
                        <div class="chat-text">Grab a brush and put a little make-up</div>
                        <div class="chat-time">07:01</div>
                    </div>
                </div>
                @foreach ($data2 as $chat)
                    @if ($chat->from_id == Auth::user()->id)
                        <div class="chat-item chat-right" style=""><img src="../assets/img/avatar/avatar-2.png">
                            <div class="chat-details">
                                <div class="chat-text">{{ $chat->message }}</div>
                                <div class="chat-time">07:01</div>
                            </div>
                        </div>
                    @else
                        <div class="chat-item chat-left" style=""><img src="../assets/img/avatar/avatar-5.png">
                            <div class="chat-details">
                                <div class="chat-text">{{ $chat->message }}</div>
                                <div class="chat-time">07:01</div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
            <div class="card-footer chat-form">
                <form id="chat-form2" method="POST" action="">
                    @csrf
                    <input type="text" class="form-control" placeholder="Type a message" name="message">
                    <button class="btn btn-primary">
                        <i class="far fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Group</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                        <img alt="image" class="rounded-circle mr-3" width="50"
                            src="../assets/img/avatar/avatar-1.png">
                        <div class="media-body">
                            <div class="font-weight-bold mt-0 mb-1">Hasan Basri</div>
                            <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i>
                                Online
                            </div>
                        </div>
                    </li>
                    <li class="media">
                        <img alt="image" class="rounded-circle mr-3" width="50"
                            src="../assets/img/avatar/avatar-2.png">
                        <div class="media-body">
                            <div class="font-weight-bold mt-0 mb-1">Bagus Dwi Cahya</div>
                            <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i>
                                Offline
                            </div>
                        </div>
                    </li>
                    <li class="media">
                        <img alt="image" class="rounded-circle mr-3" width="50"
                            src="../assets/img/avatar/avatar-3.png">
                        <div class="media-body">
                            <div class="font-weight-bold mt-0 mb-1">Wildan Ahdian</div>
                            <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i>
                                Online
                            </div>
                        </div>
                    </li>
                    <li class="media">
                        <img alt="image" class="rounded-circle mr-3" width="50"
                            src="../assets/img/avatar/avatar-4.png">
                        <div class="media-body">
                            <div class="font-weight-bold mt-0 mb-1">Rizal Fakhri</div>
                            <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i>
                                Online
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    {{-- <div class="cartData"></div> --}}
    <!-- The core Firebase JS SDK is always required and must be listed first -->

    </section>

    @section('plugin_js')
        <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
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
            firebase.initializeApp();
            const messaging = firebase.messaging();

            function startFCM() {
                messaging
                    .requestPermission()
                    .then(function() {
                        return messaging.getToken()
                    })
                    .then(function(response) {
                        console.log(response);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{ route('store.token') }}',
                            type: 'POST',
                            data: {
                                token: response
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                alert('Token stored.');
                            },
                            error: function(error) {
                                console.log(error);
                                alert(error);
                            },
                        });
                    }).catch(function(error) {
                        alert(error);
                    });
            }
            messaging.onMessage(function(payload) {
                console.log(payload);
                const title = payload.notification.title;
                const options = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(title, options);
            });
        </script>
        <script>
            function FCM() {
                $.ajax(
                    type: 'GET',
                    url: 'testload'
                    function(data) {
                        $(".cartData").html(data);
                    }
                );
            }

            $(document).ready(function() {
                $("#aa").click(function() {
                    $(this).hide();
                });
            });
        </script>
    @endsection
@endsection --}}



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
                        <div class="card-stats-title">Order Statistics -
                            <div class="dropdown d-inline">
                                <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"
                                    id="orders-month">August</a>
                                <ul class="dropdown-menu dropdown-menu-sm">
                                    <li class="dropdown-title">Select Month</li>
                                    <li><a href="#" class="dropdown-item">January</a></li>
                                    <li><a href="#" class="dropdown-item">February</a></li>
                                    <li><a href="#" class="dropdown-item">March</a></li>
                                    <li><a href="#" class="dropdown-item">April</a></li>
                                    <li><a href="#" class="dropdown-item">May</a></li>
                                    <li><a href="#" class="dropdown-item">June</a></li>
                                    <li><a href="#" class="dropdown-item">July</a></li>
                                    <li><a href="#" class="dropdown-item active">August</a></li>
                                    <li><a href="#" class="dropdown-item">September</a></li>
                                    <li><a href="#" class="dropdown-item">October</a></li>
                                    <li><a href="#" class="dropdown-item">November</a></li>
                                    <li><a href="#" class="dropdown-item">December</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">24</div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">12</div>
                                <div class="card-stats-item-label">Shipping</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">23</div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
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
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Balance</h4>
                        </div>
                        <div class="card-body">
                            $187,13
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
                            4,732
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

            <div class="col-md-8 col-sm-12">
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
            </div>
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
                                                style="width: 43%;"></div>
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

        <div class="section-body">
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
        </div>
    </section>
@section('plugin_js')
    @vite(['resources/js/chartjs/Chart.min.js'])
    <script src="{{ asset('') }}/assets/js/page/modules-chartjs.js"></script>

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
