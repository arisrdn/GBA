@extends('layouts.admin-main')

@section('title')
    Rencana Baca
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Rencana Baca</h1>
            @include('layouts.partials.breadcums')
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.partials.flash-message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Rencana Baca</h4>
                            <div class="card-header-action">

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addChurch">
                                    Tambah Rencana Baca
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-church">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $dat => $data)
                                            <tr>
                                                <td>
                                                    {{ $dat + 1 }}
                                                </td>


                                                <td>
                                                    {{ $data->description }}
                                                </td>
                                                <td>
                                                    <a href="#" id="btn-edit" data-toggle="modal"
                                                        data-target="#Modaledit" data-name="{{ $data->description }}"
                                                        data-id="{{ $data->id }}"
                                                        class="btn btn-icon btn-outline-primary">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="#" id="btn-delete" data-toggle="modal"
                                                        data-target="#Modaldelete" data-name="{{ $data->description }}"
                                                        data-id="{{ $data->id }}"
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
    <div class="modal fade" id="addChurch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('rencana.baca') }}" method="POST">
            @csrf
            {{-- @method('PUT') --}}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Rencana Baca</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="description" class="form-control" required>
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
    <div class="modal fade" id="Modaledit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <form action="{{ route('rencana.baca') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">Edit Rencana Baca</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="description" class="form-control" required id="edit-name" required>
                            <input type="hidden" name="id" class="form-control" required id="edit-id">
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
    <div class="modal fade" id="Modaldelete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <form action="{{ route('rencana.baca') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete">Hapus data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            Yakin akan di hapus ?
                            <input type="hidden" name="id" class="form-control" required id="hapus-id">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-shadow">Ya</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
