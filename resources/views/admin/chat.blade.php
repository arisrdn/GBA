@extends('layouts.admin-main')

@section('title')
    Chat
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Chat</h1>
            @include('layouts.partials.breadcums')
        </div>

        <div class="section-body">
            @include('layouts.partials.flash-message')

            <div id="root"></div>
        </div>
    </section>
@section('plugin_js')
    @viteReactRefresh


    @vite(['resources/react/message.jsx'])
@endsection
@endsection
