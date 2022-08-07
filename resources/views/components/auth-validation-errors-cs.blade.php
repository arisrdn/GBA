@props(['errors'])
@if ($errors->any())
    <div {{ $attributes }}>
        @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach

    </div>
@endif
