@extends('layouts.admin-main')

@section('title')
    Profile
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Group</h1>
            @include('layouts.partials.breadcums')
        </div>

        @include('layouts.partials.flash-message')
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>Approve </h4>
                            <div class="card-header-action">

                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addChurch">
                                    Tambah Gereja
                                </button> --}}

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-church">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Rencana Baca</th>
                                            <th>Group </th>
                                            <th>Bersedia Pindah</th>
                                            <th>Tranfer Ke</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($member as $k => $dat)
                                            <tr>
                                                <td>
                                                    {{ $k + 1 }}

                                                </td>
                                                <td>{{ $dat->user->name }}</td>
                                                <td>{{ $dat->user->memberactive[0]->group->plan->description }}</td>
                                                <td>{{ $dat->user->memberactive[0]->group->name }}</td>
                                                <td>{{ $dat->data ? 'Bersedia' : 'Tidak' }}</td>
                                                <td>
                                                    @php
                                                        $filtered_arr = [];
                                                        
                                                        foreach ($group as $name => $employee) {
                                                            //If the salary is more than 12,0000.
                                                            if ($employee->group_plan_id == $dat->user->memberactive[0]->group->group_plan_id) {
                                                                //Push to filtered array
                                                                array_push($filtered_arr, $employee);
                                                            }
                                                        }
                                                        
                                                    @endphp
                                                    @if ($dat->data)
                                                        @if ($filtered_arr)
                                                            <select class="form-control-sm" id="gp{{ $dat->id }}">
                                                                @foreach ($filtered_arr as $gm)
                                                                    <option value="{{ $gm->id }}">{{ $gm->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            {{ $dat->data ? ' Group Tidak tersedia' : '-' }}
                                                        @endif
                                                    @else
                                                        {{ $dat->data ? ' Group Tidak tersedia' : '-' }}
                                                    @endif


                                                </td>
                                                {{-- <td>{{ $dat->created_at }}</td> --}}
                                                <td>
                                                    {{-- <form method="post" action="{{ url('/approve/join') }}"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        <input type="hidden" id="custId" name="id"
                                                            value="{{ $dat->id }} ">
                                                        <button type="submit" class="btn btn-primary">approve</button>
                                                    </form> --}}
                                                    @if ($dat->data)
                                                        @if ($filtered_arr)
                                                            <a href="#" id="btn-approve" data-toggle="modal"
                                                                data-target="#modalapprove" data-wl="{{ $dat }}"
                                                                data-name="{{ $dat->user->name }}"
                                                                data-plan="{{ $dat->user->memberactive[0]->group->plan->description }}"
                                                                data-gm="{{ $dat->user->memberactive[0]->id }}"
                                                                class="btn btn-primary">
                                                                Approve</a>
                                                        @else
                                                            <a href="#" class="btn disabled btn-primary">Approve</a>
                                                        @endif
                                                    @else
                                                        <a href="#" id="btn-approve2" data-toggle="modal"
                                                            data-target="#modalapprove2" data-wl="{{ $dat }}"
                                                            data-name="{{ $dat->user->name }}"
                                                            data-group="{{ $dat->user->memberactive[0]->group->name }}"
                                                            data-gm="{{ $dat->user->memberactive[0]->id }}"
                                                            class="btn btn-primary">
                                                            Approve</a>
                                                    @endif


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

        </div>


    </section>

    <div class="modal fade" id="modalapprove" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <form action="{{ route('transfer') }}" method="POST">
            @csrf
            @method('post')
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">Approve </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="name" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Rencana Baca</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="plan" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Group</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="group" value="">
                            </div>
                        </div>
                        <input type="hidden" readonly class="form-control-plaintext" id="group_id" value=""
                            name="group_id">
                        <input type="hidden" readonly class="form-control-plaintext" id="wl_id" value=""
                            name="wl_id">
                        <input type="hidden" readonly class="form-control-plaintext" id="gm_id" value=""
                            name="gm_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Approve </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="modalapprove2" tabindex="-1" role="dialog" aria-labelledby="edit"
        aria-hidden="true">
        <form action="{{ route('transfer') }}" method="POST">
            @csrf
            @method('post')
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">Approve </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="name2"
                                    value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Group </label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="group2"
                                    value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="plan2"
                                    value="Tidak Bersedia ">
                            </div>
                        </div>

                        <input type="hidden" readonly class="form-control-plaintext" id="wl_id2" value=""
                            name="wl_id">
                        <input type="hidden" readonly class="form-control-plaintext" id="gm_id2" value=""
                            name="gm_id">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Approve </button>
                    </div>
                </div>
            </div>
        </form>
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

        $("#table-church").dataTable({
            "columnDefs": [{
                // "sortable": false,
                // "targets": [2, 3]
            }]
        });
    </script>

    <script type="text/javascript">
        $(document).on("click", "#btn-approve", function() {
            var itemname = $(this).attr('data-name');
            var itempalan = $(this).attr('data-plan');
            var itemgm = $(this).attr('data-gm');
            var item = JSON.parse($(this).attr('data-wl'))
            var e = document.getElementById("gp" + item.id);
            var value = e.options[e.selectedIndex].value;
            var text = e.options[e.selectedIndex].text;
            $('#name').val(itemname);
            $('#plan').val(itempalan);
            $('#group').val(text);
            $('#group_id').val(value);
            $('#wl_id').val(item.id);
            $('#gm_id').val(itemgm);
        });

        $(document).on("click", "#btn-approve2", function() {
            var itemgroup = $(this).attr('data-group');
            var itemgm = $(this).attr('data-gm');
            var itemname = $(this).attr('data-name');
            var item = JSON.parse($(this).attr('data-wl'))
            $('#name2').val(itemname);
            $('#group2').val(itemgroup);
            $('#wl_id2').val(item.id);
            $('#gm_id2').val(itemgm);;
        });
    </script>
@endsection
@endsection
