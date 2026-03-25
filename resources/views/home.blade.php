@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    <div class="date-nav">
        <a href="?date={{ $date->copy()->subDay()->format('Y-m-d') }}" class="date-arrow">‹</a>
        <div style="display:flex;align-items:center;gap:12px;">
            <span class="date-label">{{ $date->format('l, j F Y') }}</span>
            @if($date->isToday())
                <span class="date-today">Today</span>
            @endif
        </div>
        <a href="?date={{ $date->copy()->addDay()->format('Y-m-d') }}" class="date-arrow">›</a>
    </div>

    <div class="date-nav">
        @if($date->gt(now()->subDay()->startOfDay()))
            <a href="?date={{ $date->copy()->subDay()->format('Y-m-d') }}" class="date-arrow">‹</a>
        @else
            <div class="date-arrow" style="opacity: 0.3; cursor: not-allowed;">‹</div>
        @endif

        <div style="display:flex;align-items:center;gap:12px;">
            <span class="date-label">{{ $date->format('l, j F Y') }}</span>
            @if($date->isToday()) <span class="date-today">Today</span> @endif
        </div>

        @if($date->lt(now()->addDay()->startOfDay()))
            <a href="?date={{ $date->copy()->addDay()->format('Y-m-d') }}" class="date-arrow">›</a>
        @else
            <div class="date-arrow" style="opacity: 0.3; cursor: not-allowed;">›</div>
        @endif
    </div>

    <div class="content">
        <div style="display:grid;grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap:24px;">
            <div>
                <div class="section-header">
                    <span class="section-title">Completed</span>
                    <span class="section-pill pill-done">{{ $completed->count() }} matches</span>
                </div>
                @forelse($completed as $game)
                    <div class="match-card">
                        <div class="team-side">
                            <img src="{{ $game->homeTeam->crest_url }}" alt="" class="team-badge-img">
                            <div class="team-name">{{ $game->homeTeam->name }}</div>
                        </div>

                        <div class="score-center">
                            @if($game->status == 'FINISHED')
                                <div class="score-big">{{ $game->score_home }} – {{ $game->score_away }}</div>
                                <div class="score-status">FT</div>
                            @else
                                <div class="score-time">{{ Carbon::parse($game->match_date)->format('H:i') }}</div>
                            @endif
                        </div>

                        <div class="team-side right">
                            <img src="{{ $game->awayTeam->crest_url }}" alt="" class="team-badge-img">
                            <div class="team-name">{{ $game->awayTeam->name }}</div>
                        </div>
                    </div>
                @empty
                    <p>No completed matches for this date.</p>
                @endforelse
            </div>

            <div>
                <div class="section-header">
                    <span class="section-title">Upcoming</span>
                    <span class="section-pill pill-upcoming">{{ $upcoming->count() }} matches</span>
                </div>
                @forelse($upcoming as $game)
                    <div class="match-card">
                        <div class="team-side">
                            <img src="{{ $game->homeTeam->crest_url }}" alt="" class="team-badge-img">
                            <div class="team-name">{{ $game->homeTeam->name }}</div>
                        </div>

                        <div class="score-center">
                            <div class="score-time">{{ Carbon::parse($game->match_date)->format('H:i') }}</div>
                        </div>

                        <div class="team-side right">
                            <img src="{{ $game->awayTeam->crest_url }}" alt="" class="team-badge-img">
                            <div class="team-name">{{ $game->awayTeam->name }}</div>
                        </div>
                    </div>
                @empty
                    <p>No upcoming matches for this date.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
