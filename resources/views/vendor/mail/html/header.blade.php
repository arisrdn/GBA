<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{url('/logo-GBA.png')}}" class="logo" alt="Laravel Logo">
<!-- <h2> GBA </h2> -->
@else
<!-- <img src=src="{{url('/logo-GBA.png')}}" class="logo" alt="GBA"> -->
<img src="{{asset('logo-GBA.png')}}" class="logo" alt="GBA">


<!-- {{ $slot }} -->
@endif
</a>
</td>
</tr>
