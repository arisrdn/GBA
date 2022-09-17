@extends('layouts.admin-main')

@section('title')
    Chat
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <button" id="aa" class="btn btn-danger btn-flat">Allow notification
                        </button>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Who's Online?</h4>
                        <a id="option1" data-id="10" data-option="21" href="#"
                            onclick="goDoSomething(this.getAttribute('data-id'), this.getAttribute('data-option'));">
                            Click to do something
                        </a>
                        <select class="form-select" id="select">

                            <option>pilih produk</option>
                            <?php foreach ($data1 as $user): ?>

                            <option value="#"> sasasa</option>

                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($data1 as $user)
                                {{-- <a id="" data-id="10" data-option="21" href="#"> --}}

                                <li class="media contact" data-id="{{ $user->id }}" data-option="1"
                                    onclick="goDoSomething(this.getAttribute('data-id'), this.getAttribute('data-option'));">
                                    <img alt="image" class="rounded-circle mr-3" width="50"
                                        src="../assets/img/avatar/avatar-1.png">
                                    <div class="media-body">
                                        <div class="font-weight-bold mt-0 mb-1">{{ $user->name }}</div>
                                        <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i>
                                            Online
                                        </div>
                                    </div>
                                </li>
                                {{-- </a> --}}
                            @endforeach

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
                    <div id="abaaba" class="card-body chat-content" tabindex="2"
                        style="overflow: hidden; outline: none;">


                    </div>
                    <div class="card-footer chat-form">
                        <form id="chatform" method="POST" action="https://gba.test/chat" id="chatForm">
                            @csrf
                            <input type="text" class="form-control" placeholder="Type a message" name="message"
                                id="message">
                            <input type="hidden" name="to_id" id="toid">
                            <input type="hidden" name="option" id="option">
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
`@section('plugin_css')
    <style>
        .contact:hover {
            border-top: 1px solid #0278a3;
            border-bottom: 1px solid #0278a3;
            cursor: pointer
        }
    </style>
@endsection

@section('plugin_js')
    <script>
        chatBox = document.querySelector("#abaaba");

        function scrollToBottom() {
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        setInterval(() => {
            if ($("#option").val()) {
                $.ajax({
                    method: 'get',
                    url: "render",
                    data: {
                        data: $("#option").val(),
                        id: $("#toid").val(),
                    },

                    success: function(data) {
                        $('#abaaba').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }

                });

            } else {
                console.log('bbb');

            }
        }, 500);

        // Submit message
        var frm = $('#chatform');
        frm.submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function(data) {
                    console.log('Submission was successful.');
                    $("#message").val("");
                    scrollToBottom();
                    // console.log(data);

                },
                error: function(data) {
                    console.log('An error occurred.');
                    console.log(data);
                },
            });
        });
    </script>

    <script type="text/javascript">
        function goDoSomething(data_id, data_option) {
            $('#toid').val(data_id);
            $('#option').val(data_option);
            $.ajax({
                method: 'get',
                url: "render",
                data: {
                    data: data_option,
                    id: data_id,
                },

                success: function(data) {
                    $('#abaaba').html(data);
                    scrollToBottom();
                },
                error: function(error) {
                    console.log(error);
                }

            });
        }
    </script>
    {{-- <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
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
    </script> --}}
@endsection
@endsection
