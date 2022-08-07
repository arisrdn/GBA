@extends('layouts.guest-main')

@section('title')
    Forgot Password
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
                            <h4>Forgot Password</h4>
                        </div>

                        <div class="card-body">
                            {{-- <p class="text-muted">We will send a link to reset your password</p> --}}
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <!-- Validation Errors -->
                            <x-auth-validation-errors-cs class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                        required autofocus>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Forgot Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('layouts.partials.footer-2')
                </div>
            </div>
        </div>
    </section>
@endsection
