@extends('layouts.admin-main')

@section('title')
    Group
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Chat</h1>
            @include('layouts.partials.breadcums')
        </div>
        @include('layouts.partials.flash-message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('broadcast') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="card">
                            <div class="card-header">
                                <h4>Broadcast Message</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">To</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="to">
                                            <option value="member">Member Group</option>
                                            <option value="pic">PIC/admin</option>
                                            <option value="all">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Message</label>
                                    <div class="col-sm-12 col-md-7">
                                        {{-- <textarea class="summernote-simple"></textarea> --}}
                                        <textarea class="form-control" rows="10" style="height: 100px" required name="message"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Publish</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                {{-- <button class="btn btn-primary mr-1" type="submit">Simpan</button> --}}

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
