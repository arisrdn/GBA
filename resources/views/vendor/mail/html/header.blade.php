<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src=src="{{url('/logo-GBA.png')}}" class="logo" alt="Laravel Logo">
<!-- <h2> GBA </h2> -->
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
