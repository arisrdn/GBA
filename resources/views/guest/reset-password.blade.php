@extends('layouts.guest-main')

@section('title')
    Reset Password
@endsection
{{-- <img src="{{ asset('/') }}assets/img/logo-GBA-gemar-baca-alkitab.svg" alt="logo" width="100" --}}

@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('/') }}assets/img/logo-GBA-gemar-baca-alkitab.svg" alt="logo" width="100">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Reset Password</h4>
                        </div>

                        <div class="card-body">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors-cs class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <x-input id="email" ype="email" class="form-control" name="email"
                                        tabindex="1" :value="old('email', $request->email)" required autofocus />
                                </div>

                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input id="password" type="password" class="form-control pwstrength"
                                        data-indicator="pwindicator" name="password" tabindex="2" required>
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" tabindex="2" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Reset Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer">
                        @include('layouts.partials.footer-2')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
