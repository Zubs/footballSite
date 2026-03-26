@php use Carbon\Carbon; @endphp
<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 400px), 1fr)); gap:24px;">

    <div style="min-width: 0;">
        <div class="section-header">
            <span class="section-title">Completed</span>
            <span class="section-pill"
                  style="background: var(--sky-light); color: var(--sky-dark); padding: 2px 8px; border-radius: 10px; font-size: 11px;">{{ $completed->count() }} matches</span>
        </div>

        @forelse($completed as $game)
            <a href="{{ route('matches.show', $game->id) }}"
               style="text-decoration: none; color: inherit; display: block; margin-bottom: 12px;">
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
                            <div style="font-weight: 700; margin-top: 4px; font-size: 14px;">{{ $game->score_home }}
                                - {{ $game->score_away }}</div>
                        @else
                            <div class="score-time">{{ Carbon::parse($game->game_date)->format('H:i') }}</div>
                        @endif

                        <div style="font-size: 10px; color: var(--text-muted); margin-top: 8px; line-height: 1.3;">
                            {{ $game->league_name }}<br>
                            <span style="opacity: 0.8;">{{ $game->league_round }} • {{ $game->season }}</span>
                        </div>
                    </div>

                    <div class="team-side right">
                        <img src="{{ $game->awayTeam->crest_url }}" class="team-badge-img" alt="">
                        <div class="team-name">{{ $game->awayTeam->name }}</div>
                    </div>
                </div>
            </a>
        @empty
            <p style="color: var(--text-muted); font-size: 14px; padding: 20px; text-align: center;">No completed
                matches found.</p>
        @endforelse
    </div>

    <div style="min-width: 0;">
        <div class="section-header">
            <span class="section-title">Upcoming</span>
            <span class="section-pill"
                  style="background: var(--pink-light); color: var(--pink-dark); padding: 2px 8px; border-radius: 10px; font-size: 11px;">{{ $upcoming->count() }} matches</span>
        </div>

        @forelse($upcoming as $game)
            <a href="{{ route('matches.show', $game->id) }}"
               style="text-decoration: none; color: inherit; display: block; margin-bottom: 12px;">
                <div class="match-card">
                    <div class="team-side">
                        <img src="{{ $game->homeTeam->crest_url }}" class="team-badge-img" alt="">
                        <div class="team-name">{{ $game->homeTeam->name }}</div>
                    </div>

                    <div class="score-center">
                        @if($game->status === 'LIVE')
                            <div class="score-time" style="background: var(--sky-dark); color: white;">LIVE</div>
                            <div style="font-weight: 700; margin-top: 4px; font-size: 14px;">{{ $game->score_home }}
                                - {{ $game->score_away }}</div>
                        @elseif($game->status === 'CANCELLED')
                            <div class="score-time" style="background: #666; color: white;">CANCELLED</div>
                        @else
                            <div class="score-time">{{ Carbon::parse($game->game_date)->format('H:i') }}</div>
                        @endif

                        <div style="font-size: 10px; color: var(--text-muted); margin-top: 8px; line-height: 1.3;">
                            {{ $game->league_name }}<br>
                            <span style="opacity: 0.8;">{{ $game->league_round }} • {{ $game->season }}</span>
                        </div>
                    </div>

                    <div class="team-side right">
                        <img src="{{ $game->awayTeam->crest_url }}" class="team-badge-img" alt="">
                        <div class="team-name">{{ $game->awayTeam->name }}</div>
                    </div>
                </div>
            </a>
        @empty
            <p style="color: var(--text-muted); font-size: 14px; padding: 20px; text-align: center;">No upcoming matches
                found.</p>
        @endforelse
    </div>
</div>
