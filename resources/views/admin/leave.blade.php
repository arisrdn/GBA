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
                <div class="col">
                    @include('layouts.partials.flash-message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Setujui Keluar Group</h4>
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
                                            <th>nama</th>
                                            <th>group </th>
                                            <th>reason </th>
                                            <th>Catatan </th>
                                            <th>request leave</th>
                                            <th>action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($member as $k => $dat)
                                            <tr>
                                                <td>
                                                    {{ $k + 1 }}</td>
                                                <td>{{ $dat->user->name }}</td>
                                                <td>{{ $dat->user->memberactive[0]->group->name }}</td>
                                                <td>{{ $dat->reason->reason }}</td>
                                                @php
                                                    $a = json_decode($dat->data);
                                                @endphp
                                                <td>{{ $a->note }}</td>
                                                <td>{{ $dat->updated_at }}</td>
                                                <td>
                                                    <form method="post" action="{{ route('leave') }}"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        <input type="hidden" id="custId" name="wl_id"
                                                            value="{{ $dat->id }} ">
                                                        <input type="hidden" id="custId" name="gm_id"
                                                            value="{{ $dat->user->memberactive[0]->id }} ">
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
