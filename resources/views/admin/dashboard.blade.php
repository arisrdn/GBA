@extends('layouts.admin-main')

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        {{-- <div class="row">
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
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>News</h4>
                        </div>
                        <div class="card-body">
                            42
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Reports</h4>
                        </div>
                        <div class="card-body">
                            1,201
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Online Users</h4>
                        </div>
                        <div class="card-body">
                            47
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">

            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>test approve</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table-bordered table">
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>nama</th>
                                        <th>group</th>
                                        <th>request</th>
                                        <th>action</th>
                                    </tr>


                                    @foreach ($member as $dat)
                                        <tr>
                                            <td>
                                                {{ $dat->id }}</td>
                                            <td>{{ $dat->user->name }}</td>
                                            <td>{{ $dat->group->name }}</td>
                                            <td>{{ $dat->created_at }}</td>
                                            <td>
                                                <form method="post" action="{{ url('/approve/join') }}"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" id="custId" name="id"
                                                        value="{{ $dat->id }} ">
                                                    <button type="submit" class="btn btn-primary">approve</button>
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
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Test leave group</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table-bordered table">
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>nama</th>
                                        <th>group </th>
                                        <th>reason </th>
                                        <th>request leave</th>
                                        <th>action</th>
                                    </tr>


                                    @foreach ($member2 as $dat)
                                        <tr>
                                            <td>
                                                {{ $dat->id }}</td>
                                            <td>{{ $dat->user->name }}</td>
                                            <td>{{ $dat->group->name }}</td>
                                            <td>{{ $dat->reason_leave }}</td>
                                            <td>{{ $dat->updated_at }}</td>
                                            <td>
                                                <form method="post" action="{{ url('/approve/leave') }}"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" id="custId" name="id"
                                                        value="{{ $dat->id }} ">
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

    </section>
@endsection
