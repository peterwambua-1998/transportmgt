<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@php
    $logo = $settings->company_logo ?? 'logo.png';
@endphp
@if (trim($slot) === 'Laravel')
<img src="{{ asset('images/'.$logo) }}" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
