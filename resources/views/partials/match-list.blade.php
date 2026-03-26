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
                        <div class="score-big">{{ $game->score_home }} – {{ $game->score_away }}</div>
                        <div class="score-status">FT</div>
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
                        <div class="score-time">{{ Carbon::parse($game->match_date)->format('H:i') }}</div>
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
