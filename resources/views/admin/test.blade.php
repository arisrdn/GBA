@extends('layouts.admin-main')

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
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($data1 as $user)
                                <li class="media">
                                    <img alt="image" class="rounded-circle mr-3" width="50"
                                        src="../assets/img/avatar/avatar-1.png">
                                    <div class="media-body">
                                        <div class="font-weight-bold mt-0 mb-1">{{ $user->name }}</div>
                                        <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i>
                                            Online
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                            <li class="media">
                                <img alt="image" class="rounded-circle mr-3" width="50"
                                    src="../assets/img/avatar/avatar-2.png">
                                <div class="media-body">
                                    <div class="font-weight-bold mt-0 mb-1">Bagus Dwi Cahya</div>
                                    <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Offline
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
                                <div class="chat-item chat-right" style=""><img
                                        src="../assets/img/avatar/avatar-2.png">
                                    <div class="chat-details">
                                        <div class="chat-text">{{ $chat->message }}</div>
                                        <div class="chat-time">07:01</div>
                                    </div>
                                </div>
                            @else
                                <div class="chat-item chat-left" style=""><img
                                        src="../assets/img/avatar/avatar-5.png">
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
@endsection
