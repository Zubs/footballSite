@php use Carbon\Carbon; @endphp
<div style="display:grid;grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap:24px;">
    <div>
        <div class="section-header">
            <span class="section-title">Completed</span>
            <span class="section-pill pill-done">{{ $completed->count() }} matches</span>
        </div>

        @forelse($completed as $game)
            <a href="{{ route('matches.show', $game->id) }}" style="text-decoration: none; color: inherit;">
                <div class="match-card">
                    <div class="team-side">
                        <img src="{{ $game->homeTeam->crest_url }}" class="team-badge-img" alt="">
                        <div class="team-name">{{ $game->homeTeam->name }}</div>
                    </div>

                    <div class="score-center">
                        @if($game->status == 'FINISHED')
                            <div class="score-big">{{ $game->score_home }} – {{ $game->score_away }}</div>
                            <div class="score-status">FT • {{ Carbon::parse($game->game_date)->format('H:i') }}</div>
                        @elseif($game->status === 'LIVE')
                            <div class="score-time" style="background: #FF4B4B; color: white;">LIVE</div>
                            <div style="font-weight: 700; margin-top: 4px;">{{ $game->score_home }} - {{ $game->score_away }}</div>
                        @else
                            <div class="score-time">{{ Carbon::parse($game->game_date)->format('H:i') }}</div>
                        @endif

                        <div style="font-size: 10px; color: var(--text-muted); margin-top: 8px;">
                            {{ $game->league_round }}, {{ $game->league_name }} ({{ $game->league_country }}
                            ) {{ $game->season }}
                        </div>
                    </div>

                    <div class="team-side right">
                        <img src="{{ $game->awayTeam->crest_url }}" class="team-badge-img" alt="">
                        <div class="team-name">{{ $game->awayTeam->name }}</div>
                    </div>
                </div>
            </a>
        @empty
            <p style="color: var(--text-muted); font-size: 14px;">No completed matches.</p>
        @endforelse
    </div>

    <div>
        <div class="section-header">
            <span class="section-title">Upcoming</span>
            <span class="section-pill pill-upcoming">{{ $upcoming->count() }} matches</span>
        </div>
        @forelse($upcoming as $game)
            <a href="{{ route('matches.show', $game->id) }}" style="text-decoration: none; color: inherit;">
                <div class="match-card">
                    <div class="team-side">
                        <img src="{{ $game->homeTeam->crest_url }}" class="team-badge-img" alt="">
                        <div class="team-name">{{ $game->homeTeam->name }}</div>
                    </div>

                    <div class="score-center">
                        @if($game->status == 'FINISHED')
                            <div class="score-big">{{ $game->score_home }} – {{ $game->score_away }}</div>
                            <div class="score-status">FT • {{ Carbon::parse($game->game_date)->format('H:i') }}</div>
                        @elseif($game->status === 'LIVE')
                            <div class="score-time" style="background: blue; color: white;">LIVE</div>
                            <div style="font-weight: 700; margin-top: 4px;">{{ $game->score_home }} - {{ $game->score_away }}</div>
                        @elseif($game->status === 'CANCELLED')
                            <div class="score-time" style="background: #FF4B4B; color: white;">CANCELLED</div>
                            <div style="font-weight: 700; margin-top: 4px;">{{ $game->score_home }} - {{ $game->score_away }}</div>
                        @else
                            <div class="score-time">{{ Carbon::parse($game->game_date)->format('H:i') }}</div>
                        @endif

                        <div style="font-size: 10px; color: var(--text-muted); margin-top: 8px;">
                            {{ $game->league_round }}, {{ $game->league_name }} ({{ $game->league_country }}
                            ) {{ $game->season }}
                        </div>
                    </div>

                    <div class="team-side right">
                        <img src="{{ $game->awayTeam->crest_url }}" class="team-badge-img" alt="">
                        <div class="team-name">{{ $game->awayTeam->name }}</div>
                    </div>
                </div>
            </a>
        @empty
            <p style="color: var(--text-muted); font-size: 14px;">No upcoming matches.</p>
        @endforelse
    </div>
</div>
