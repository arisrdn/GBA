@extends('layouts.admin-main')

@section('title')
    Group
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Grup</h1>
            @include('layouts.partials.breadcums')
        </div>

        @include('layouts.partials.flash-message')
        <div class="section-body">
            <h2 class="section-title">{{ $data->name }}</h2>
            <div class="row">
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
                                {{ count($data->admin) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Anggota</h4>
                            </div>
                            <div class="card-body">
                                {{ count($data->user) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-bible"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Bacaan</h4>
                            </div>
                            <div class="card-body">
                                <h6>

                                    {{ $data->plan->description }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Waktu</h4>
                            </div>
                            <div class="card-body">
                                {{-- {{ date('H:i', strtotime($data->eod->start)) . ' - ' . date('H:i', strtotime($data->eod->end)) }} --}}
                                {{ $data->plan->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h4>Member</h4>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-user">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Nama </th>
                                            <th>Progress </th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data->member as $dat => $da)
                                            <tr>
                                                <td>
                                                    {{ $dat + 1 }}
                                                </td>
                                                <td>{{ $da->user->name }}</td>
                                                <td>{{ $da->user->name }}</td>


                                                <td>

                                                    <a href="#" id="btn-show" data-toggle="modal"
                                                        data-target="#modaldetail" data-name="{{ $da->name }}"
                                                        data-id="{{ $dat }}" data-user="{{ $da->user }}"
                                                        class="btn btn-icon btn-outline-primary">
                                                        <i class="fas fa-id-card"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-5">
                    {{-- <div class="card card-success">
                        <div class="card-header">
                            <h4>Waktu</h4>
                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addtime">
                                    Ubah Waktu
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <label class="col-md-4 text-md-right text-left">Waktu Baca</label>
                                <div class="col">
                                    {{ date('H:i', strtotime($data->eod->start)) . ' - ' . date('H:i', strtotime($data->eod->end)) }}
                                </div>
                            </div>

                        </div>

                    </div> --}}
                    <div class="card card-warning">
                        <div class="card-header">
                            <h4>Data grup</h4>
                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTodo">
                                    Ubah Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="profile-widget-description pb-0">
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Nama Group</label>
                                    <div class="col">
                                        <a href="{{ route('chat') . '/g/' . request('id') }}">
                                            {{ $data->name }}
                                            <i class="fas fa-comment"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left"> Waktu</label>
                                    <div class="col">
                                        {{-- {{ date('H:i', strtotime($data->eod->start)) . ' - ' . date('H:i', strtotime($data->eod->end)) }} --}}

                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Rencana Baca</label>
                                    <div class="col">
                                        {{ $data->plan->description }}
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-todo">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                hari
                                            </th>
                                            <th>Chapter </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data->todo as $todo)
                                            <tr>
                                                <td>
                                                    {{ $todo->day }}
                                                </td>
                                                <td>{{ $todo->chapter_verse }}</td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="card card-primary mt-4">
                        <div class="card-header">
                            <h4>Admin Grup</h4>
                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadmin">
                                    Tambah Admin
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-admin">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Nama </th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data->admin as $dat => $da)
                                            <tr>
                                                <td>
                                                    {{ $dat + 1 }}
                                                </td>
                                                <td>{{ $da->user->name }}</td>



                                                <td>

                                                    <a href="#" id="btn-show" data-toggle="modal"
                                                        data-target="#modaldetail" data-name="{{ $da->name }}"
                                                        data-id="{{ $dat }}" data-user="{{ $da->user }}"
                                                        class="btn btn-icon btn-outline-primary">
                                                        <i class="far fa-edit"></i></a>
                                                    <a href="#" id="btn-delete" data-toggle="modal"
                                                        data-target="#Modaldelete" data-name="{{ $da->name }}"
                                                        data-id="{{ $da->id }}"
                                                        class="btn btn-icon btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('group') . '/admin' }}" method="POST">
            @csrf
            @method('patch')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {{-- <label>Nama Admin</label> --}}
                            <select class="form-control" name="admin_id" required>
                                <option value="">..pilih..</option>
                                @foreach ($admin as $adm)
                                    <option value="{{ $adm->id }}">
                                        {{ $adm->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="group_id" value="{{ request('id') }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="modal fade" id="addTodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('group') . '/todo' }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <input type="hidden" name="group_id" value="{{ request('id') }}">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="section-title">Nama Grup</h5>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">

                                    <input type="text" class="form-control" name="name" required
                                        placeholder="Nama Grup" value="{{ $data->name }}">
                                </div>
                            </div>

                        </div>
                        <h5 class="section-title">waktu </h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group">

                                    {{-- <input type="time" class="form-control" name="start" required
                                        placeholder="04:00" value="{{ $data->eod->start }}" id="istart"> --}}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{-- <label for="inputPassword4">Password</label> --}}
                                <div class="input-group">

                                    {{-- <input type="time" class="form-control" name="end" required
                                            placeholder="20:00" value="{{ $data->eod->end }}" id="iend"> --}}
                                </div>
                            </div>
                        </div>
                        <h5 class="section-title">Bacaan </h5>
                        {{-- <div class="section-title mt-0">Upload file Bacaan</div> --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Rencana Baca</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="plan_id" required>
                                    <option value="">pilih..</option>
                                    @foreach ($plan as $pl)
                                        <option value="{{ $pl->id }}"
                                            @if ($pl->id == $data->group_plan_id) selected @endif>
                                            {{ $pl->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Upload File</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="todo"
                                        accept=" application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    <label class="custom-file-label" for="customFile">{{ $data->todo_file }}</label>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <div class="modal fade" id="addtime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('group') . '/time' }}" method="POST">
            @csrf
            @method('patch')

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah waktu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="section-title mt-0">Upload file Bacaan</div> --}}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group">

                                    {{-- <input type="time" class="form-control" name="start" required
                                        placeholder="04:00" value="{{ $data->eod->start }}" id="istart"> --}}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{-- <label for="inputPassword4">Password</label> --}}
                                <div class="input-group">

                                    {{-- <input type="time" class="form-control" name="end" required
                                            placeholder="20:00" value="{{ $data->eod->end }}" id="iend"> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="modal fade" id="addtime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('group') . '/time' }}" method="POST">
            @csrf
            @method('patch')

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah waktu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="section-title mt-0">Upload file Bacaan</div> --}}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group">

                                    {{-- <input type="time" class="form-control" name="start" required
                                        placeholder="04:00" value="{{ $data->eod->start }}" id="istart"> --}}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {{-- <label for="inputPassword4">Password</label> --}}
                                <div class="input-group">

                                    {{-- <input type="time" class="form-control" name="end" required
                                        placeholder="20:00" value="{{ $data->eod->end }}" id="iend"> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </div>
            </div>

        </form>
    </div>


    <div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="delete"
        aria-hidden="true">

        <div class="modal-dialog modal-md modal-dialog-centered" role="document">

            <div class="card profile-widget col px-0 pt-0">
                <div class="profile-widget-header">
                    <img alt="image" src="../assets/img/avatar/avatar-1.png"
                        class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Posts</div>
                            <div class="profile-widget-item-value">187</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Followers</div>
                            <div class="profile-widget-item-value">6,8K</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Following</div>
                            <div class="profile-widget-item-value">2,1K</div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description px-3">

                    <div class="form-group row align-items-center">
                        <label class="col-md-4 text-md-right text-left">Nama</label>
                        <div class="col">
                            <p id="itemname"></p>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-md-4 text-md-right text-left">Alamat</label>
                        <div class="col">
                            <p id="itemaddress"></p>
                        </div>
                    </div>
                    {{-- <div class="form-group row align-items-center">
                        <label class="col-md-4 text-md-right text-left">Tota</label>
                        <div class="col">
                            {{ count($data->todo) }}
                        </div>
                    </div> --}}
                </div>
                <div class="modal-content">
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <a type="submit" id="link" class="btn btn-primary">Kirim Pesan </a>
                    </div>
                </div>

            </div>


        </div>

    </div>
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

        $("#table-admin").dataTable({
            scrollY: '150px',
            paging: false,
            "lengthChange": false
        });
        $("#table-user").dataTable({
            "columnDefs": [{

            }]
        });
        $("#table-todo").dataTable({
            // "info": false,
            searching: false,
            scrollY: '200px',
            paging: false,
            "lengthChange": false
        });

        $(document).ready(function() {
            $('input[type="file"]').on("change", function() {
                let filenames = [];
                let files = this.files;
                if (files.length > 1) {
                    filenames.push("Total Files (" + files.length + ")");
                } else {
                    for (let i in files) {
                        if (files.hasOwnProperty(i)) {
                            filenames.push(files[i].name);
                        }
                    }
                }
                $(this)
                    .next(".custom-file-label")
                    .html(filenames.join(","));
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on("click", "#btn-show", function() {

            var itemid = $(this).attr('data-id');
            var itemname = $(this).attr('data-name');
            var itemuser = JSON.parse($(this).attr('data-user'))
            $('#edit-id').val(itemid);
            $('#edit-name').val(itemname);
            document.getElementById("itemname").innerHTML = itemuser.name;
            document.getElementById("itemaddress").innerHTML = itemuser.address;
            document.getElementById("link").href = "{{ route('chat') }}/p/" + itemuser.id + "";
            // console.log(itemid, itemname);
        });
        // $(document).on("click", "#btn-delete", function() {
        //     var itemid = $(this).attr('data-id');
        //     var itemname = $(this).attr('data-name');
        //     $('#delete-id').val(itemid);
        //     $('#delete-name').val(itemname);
        //     console.log(itemid, itemname);
        // });
    </script>
@endsection
@endsection
