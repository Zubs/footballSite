@php
    $prevDate = $date->copy()->subDay()->format('Y-m-d');
    $nextDate = $date->copy()->addDay()->format('Y-m-d');

    $prevUrl = route('home', array_filter(['date' => $prevDate, 'term' => $term ?? '', 'country' => $country ?? '']));
    $nextUrl = route('home', array_filter(['date' => $nextDate, 'term' => $term ?? '', 'country' => $country ?? '']));
@endphp

<div
    style="display: flex; align-items: center; justify-content: space-between; width: 100%; max-width: 600px; margin: 0 auto; gap: 10px;">
    @if($date->gt(now()->subDay()->startOfDay()))
        <a href="{{ $prevUrl }}" class="date-arrow" style="flex-shrink: 0;">‹</a>
    @else
        <div class="date-arrow" style="opacity: 0.3; cursor: not-allowed; flex-shrink: 0;">‹</div>
    @endif

    <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 0;">
        <span class="date-label"
              style="font-size: clamp(13px, 4vw, 16px); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%;">
            {{ $date->format('l, j F Y') }}
        </span>
        @if($date->isToday())
            <span class="date-today" style="margin-top: 4px;">Today</span>
        @endif
    </div>

    @if($date->lt(now()->addDay()->startOfDay()))
        <a href="{{ $nextUrl }}" class="date-arrow" style="flex-shrink: 0;">›</a>
    @else
        <div class="date-arrow" style="opacity: 0.3; cursor: not-allowed; flex-shrink: 0;">›</div>
    @endif
</div>
