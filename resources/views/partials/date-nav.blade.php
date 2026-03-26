@php
    $prevDate = $date->copy()->subDay()->format('Y-m-d');
    $nextDate = $date->copy()->addDay()->format('Y-m-d');

    $prevUrl = route('home', array_filter(['date' => $prevDate, 'term' => $term, 'country' => $country]));
    $nextUrl = route('home', array_filter(['date' => $nextDate, 'term' => $term, 'country' => $country]));
@endphp

@if($date->gt(now()->subDay()->startOfDay()))
    <a href="{{ $prevUrl }}" class="date-arrow">‹</a>
@else
    <div class="date-arrow" style="opacity: 0.3; cursor: not-allowed;">‹</div>
@endif

<div style="display:flex;align-items:center;gap:12px;">
    <span class="date-label">{{ $date->format('l, j F Y') }}</span>
    @if($date->isToday()) <span class="date-today">Today</span> @endif
</div>

@if($date->lt(now()->addDay()->startOfDay()))
    <a href="{{ $nextUrl }}" class="date-arrow">›</a>
@else
    <div class="date-arrow" style="opacity: 0.3; cursor: not-allowed;">›</div>
@endif
