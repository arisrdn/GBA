@extends('layouts.admin-main')

@section('title')
    Anggota
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Anggota</h1>
            @include('layouts.partials.breadcums')
        </div>

        <div class="section-body">
            <div class="row">
                {{-- <div class="row gutters-sm"> --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <nav class="nav flex-column nav-pills nav-gap-y-1">
                                <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>Informasi
                                </a>
                                <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-settings mr-2">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                        </path>
                                    </svg>Ubah Kata Sandi
                                </a>

                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-bottom d-flex d-md-none mb-3">
                            <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                                <li class="nav-item">
                                    <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#account" data-toggle="tab" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                            <circle cx="12" cy="12" r="3"></circle>
                                            <path
                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                            </path>
                                        </svg></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#security" data-toggle="tab" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                        </svg></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#notification" data-toggle="tab" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#billing" data-toggle="tab" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-credit-card">
                                            <rect x="1" y="4" width="22" height="16"
                                                rx="2" ry="2"></rect>
                                            <line x1="1" y1="10" x2="23" y2="10">
                                            </line>
                                        </svg></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body tab-content">
                            <div class="tab-pane active" id="profile">
                                <h6>Informasi </h6>
                                <hr>
                                <form>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" id="" class="form-control"
                                            placeholder="masukan email" aria-describedby="helpId"
                                            value="{{ auth()->user()->email }}" disabled>
                                        {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="fullName">Nama</label>
                                        <input type="text" class="form-control" id="fullName"
                                            aria-describedby="fullNameHelp" placeholder="Masukan Nama"
                                            value="{{ auth()->user()->name }}">

                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <textarea class="form-control" id="address" placeholder="Alamat" name="address">
                                           {{ auth()->user()->address }}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="url">No Whatsapp</label>
                                        <input type="text" class="form-control" id="url"
                                            placeholder="Enter your website address"
                                            value="{{ auth()->user()->whatsapp_no }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Jemis Kelamin</label>
                                        <input type="text" class="form-control" id="location"
                                            placeholder="Enter your location" value="Bay Area, San Francisco, CA">
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Jenis kelamin</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineradio1"
                                                name="gender" value="male"
                                                @if (auth()->user()->gender == 'male') checked @endif>
                                            <label class="form-check-label" for="inlineradio1">Pria</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineradio2"
                                                name="gender" value="female"
                                                @if (auth()->user()->gender == 'female') checked @endif>

                                            <label class="form-check-label" for="inlineradio2">Wanita</label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>
                            <div class="tab-pane" id="account">
                                <h6>Ubah Kata Sandi</h6>
                                <hr>
                                <form method="POST" action={{ route('change.password') }}>
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <div class="card-body pb-2">

                                            <div class="form-group">
                                                <label class="form-label">Kata Sandi Saat Ini</label>
                                                <input type="password" class="form-control" name="old_password" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Kata Sandi Baru</label>
                                                <input type="password" class="form-control" name="password" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Ulangi Kata Sandi Baru</label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    required>
                                            </div>

                                        </div>
                                        <button class="btn btn-primary" type="submit">Ubah Kata Sandi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>

        </div>


    </section>

@section('plugin_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection
@section('plugin_js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
        });

        $("#table-church").dataTable({
            "columnDefs": [{
                // "sortable": false,
                // "targets": [2, 3]
            }]
        });
    </script>

    <script type="text/javascript">
        $(document).on("click", "#btn-edit", function() {

            var itemid = $(this).attr('data-id');
            var itemname = $(this).attr('data-name');
            $('#edit-id').val(itemid);
            $('#edit-name').val(itemname);
            console.log(itemid, itemname);
        });

        $(document).on("click", "#btn-delete", function() {

            var itemid = $(this).attr('data-id');
            var itemname = $(this).attr('data-name');
            $('#delete-id').val(itemid);
            $('#delete-name').val(itemname);
            console.log(itemid, itemname);
        });
    </script>
@endsection
@endsection
