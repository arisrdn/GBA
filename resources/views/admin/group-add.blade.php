@extends('layouts.admin-main')

@section('title')
    Group
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
                <div class="col-12">
                    <form action="{{ route('group') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card">
                            <div class="card-header">
                                <h4>Buat Group</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Rencana Baca</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="plan_id" required>
                                                    <option value="">pilih..</option>
                                                    @foreach ($plan as $data)
                                                        <option value="{{ $data->id }}">{{ $data->description }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-3 col-form-label">Nama Group</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputPassword3"
                                                    placeholder="Masukan Nama grup" name="name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">PIC</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="pic" required>
                                                    <option value="">pilih..</option>
                                                    @foreach ($user as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Co-PIC</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="copic" required>
                                                    <option value="">pilih..</option>
                                                    @foreach ($user as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 border-left border-dark">
                                        <div class="section-title mt-0">Waktu Membaca</div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="far fa-clock"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="start" required
                                                        placeholder="04:00" id="istart">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                {{-- <label for="inputPassword4">Password</label> --}}
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-clock"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="end" required
                                                        placeholder="20:00" id="iend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section-title mt-0">Upload file Bacaan</div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="todo"
                                                accept=" application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                                value="{{ $data->todo_file }}">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>



@section('plugin_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
@endsection
@section('plugin_js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
        });

        $("#istart").datetimepicker({
            format: "HH:mm",
            icons: {
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
            },
        });
        $("#iend").datetimepicker({
            format: "HH:mm",
            icons: {
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
            },
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
@endsection
@endsection
