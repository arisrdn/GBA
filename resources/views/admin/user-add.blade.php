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
                        <form class="" method="POST" action="{{ route('user') }}">
                            @csrf

                            <div class="card-header">
                                <h4>Tambah Pengguna Baru</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" required="" name="name">
                                        {{-- <div class="invalid-feedback">
                                            What's your name?
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" required="" name="email">
                                        {{-- <div class="invalid-feedback">
                                            What's your name?
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tahun Kelahiran</label>
                                    <div class="col-sm-9">
                                        <input type="year" class="form-control" required="" name="birth_date"
                                            id="year">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineradio1" name="gender"
                                                required value="male">
                                            <label class="form-check-label" for="inlineradio1">Pria</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineradio1" name="gender"
                                                required value="female">
                                            <label class="form-check-label" for="inlineradio1">Wanita</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="role" required>
                                            <option value="">Pilih...</option>
                                            @foreach ($role as $rol)
                                                <option value="{{ $rol->id }} ">
                                                    {{ $rol->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kode Telepon</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="phone_code" required>
                                            <option value="">Pilih...</option>
                                            @foreach ($country as $negara)
                                                <option value="{{ $negara->id }} "
                                                    @if ($negara->id == 102) selected @endif>{{ $negara->name }}
                                                    {{ ' (+' . $negara->phone_code . ')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No Whatsapp</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="whatsapp_no" required>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Provinsi</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="province" id="provinsi" required>
                                            <option value="">Pilih...</option>
                                            @foreach ($province as $prov)
                                                <option value="{{ $prov->id }} "
                                                    @if ($prov->id == 102) selected @endif>
                                                    {{ $prov->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kota/Kab</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="regency" id="kota" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" required="" name="address"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>


    </section>

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
                            <input type="text" name="description" class="form-control" required id="edit-name"
                                required>
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
    <div class="modal fade" id="Modaldelete" tabindex="-1" role="dialog" aria-labelledby="delete"
        aria-hidden="true">
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css"
        rel="stylesheet">
@endsection
@section('plugin_js')
    <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        function onChangeSelect(url, id, name) {
            $.ajax({
                url: url + "/" + id,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>Pilih...</option>');

                    $.each(data.data, function(key, value) {
                        $('#' + name).append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                }
            });
        }
        $(function() {
            $('#provinsi').on('change', function() {
                onChangeSelect('{{ url('/api/v1/regencies') }}', $(this).val(), 'kota');
            });
            // $('#kota').on('change', function() {
            //     onChangeSelect('{{ url('districts') }}', $(this).val(), 'kecamatan');
            // })
            // $('#kecamatan').on('change', function() {
            //     onChangeSelect('{{ url('villages') }}', $(this).val(), 'desa');
            // })
        });

        const date = new Date();
        date.setFullYear(date.getFullYear() - 7);
        // $("#year").datetimepicker({
        //     format: 'YYYY',
        //     viewMode: "years",
        //     defaultDate: date,
        //     icons: {
        //         left: "far fa-chevron-up",
        //         right: "far fa-chevron-down",
        //     },

        // });

        $(document).ready(function() {
            $("#year").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true,
                defaultViewDate: date

            });
        })
    </script>
@endsection
@endsection
