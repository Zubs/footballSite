@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    <div class="detail-container">
        <div class="detail-hero"
             style="background: linear-gradient(135deg, var(--sky-light) 0%, var(--pink-light) 100%); padding: 40px 24px; text-align: center; border-bottom: 1px solid var(--border);">

            <div style="margin-bottom: 24px;">
        <span style="background: var(--surface); padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 700; color: var(--sky-dark); border: 1px solid var(--border); text-transform: uppercase; letter-spacing: 1px;">
            {{ $game->league_name }} • {{ $game->league_country }}
        </span>
                <div style="margin-top: 10px; font-size: 13px; color: var(--text-muted); font-weight: 500;">
                    Season {{ $game->season }} • {{ $game->league_round }}
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: center; gap: 40px; margin-bottom: 16px;">
                <div class="detail-team">
                    <img src="{{ $game->homeTeam->crest_url }}" style="width: 72px; height: 72px; object-fit: contain;">
                    <div style="font-size: 18px; font-weight: 700; margin-top: 12px;">{{ $game->homeTeam->name }}</div>
                </div>

                <div style="font-family: 'DM Serif Display', serif; font-size: 56px; color: var(--text);">
                    {{ $game->score_home }} – {{ $game->score_away }}
                </div>

                <div class="detail-team">
                    <img src="{{ $game->awayTeam->crest_url }}" style="width: 72px; height: 72px; object-fit: contain;">
                    <div style="font-size: 18px; font-weight: 700; margin-top: 12px;">{{ $game->awayTeam->name }}</div>
                </div>
            </div>

            <div style="color: var(--text-muted); font-size: 14px; font-weight: 500; display: flex; flex-direction: column; align-items: center; gap: 12px;">
                <div>
                    <span style="color: var(--pink-dark); font-weight: 700;">{{ $game->status }}</span>
                    • {{ $game->venue }}
                    • {{ Carbon::parse($game->game_date)->format('H:i') }}
                    • {{ Carbon::parse($game->game_date)->format('d M Y') }}
                </div>

                <button onclick="shareMatch()" style="background: var(--surface); border: 1px solid var(--sky-mid); color: var(--sky-dark); padding: 8px 20px; border-radius: 20px; cursor: pointer; font-weight: 600; font-size: 12px; display: flex; align-items: center; gap: 6px;">
                    <span>📤</span> Share Match Details
                </button>

                <script>
                    function shareMatch() {
                        if (navigator.share) {
                            navigator.share({
                                title: '{{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}',
                                text: 'Check out the live stats and join the discussion for this match on FootballSite!',
                                url: window.location.href
                            }).then(() => {
                                console.log('Thanks for sharing!');
                            }).catch(console.error);
                        } else {
                            // Fallback for desktop browsers that don't support native share
                            alert("Copy this link to share: " + window.location.href);
                        }
                    }
                </script>
            </div>
        </div>

        <div
            style="display: grid; grid-template-columns: 1fr 1fr 350px; gap: 0; background: var(--surface); max-width: 1400px; margin: 20px auto; border-radius: 16px; overflow: hidden; border: 1px solid var(--border);">

            <div style="padding: 24px; border-right: 1px solid var(--border);">
                <h3 style="font-size: 14px; text-transform: uppercase; color: var(--text-muted); margin-bottom: 24px;">
                    Starting Lineups</h3>

                @if($game->lineups)
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        @foreach($game->lineups as $lineup)
                            <div>
                                <h4 style="font-size: 13px; color: var(--sky-dark); margin-bottom: 12px;">{{ $lineup['team']['name'] }}
                                    ({{ $lineup['formation'] }})</h4>

                                <ul style="list-style: none; padding: 0; font-size: 13px; margin-bottom: 20px;">
                                    @foreach($lineup['startXI'] as $player)
                                        <li style="padding: 6px 0; border-bottom: 1px solid #f0f0f0;">
                                            <span
                                                style="color: var(--text-muted); font-weight: 600; width: 20px; display: inline-block;">{{ $player['player']['number'] }}</span>
                                            {{ $player['player']['name'] }}
                                        </li>
                                    @endforeach
                                </ul>

                                <h5 style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 4px;">
                                    Manager</h5>
                                <p style="font-size: 13px; font-weight: 600; margin-bottom: 20px;">{{ $lineup['coach']['name'] ?? 'TBC' }}</p>

                                <h5 style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 8px;">
                                    Substitutes</h5>
                                <ul style="list-style: none; padding: 0; font-size: 12px; color: var(--text-muted);">
                                    @foreach($lineup['substitutes'] as $sub)
                                        <li style="padding: 3px 0; border-bottom: 1px dotted #eee;">{{ $sub['player']['name'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: var(--text-muted); text-align: center;">Lineups pending...</p>
                @endif
            </div>

            <div style="padding: 24px; border-right: 1px solid var(--border); background: #fdfdfd;">
                <h3 style="font-size: 14px; text-transform: uppercase; color: var(--text-muted); margin-bottom: 24px;">
                    Match Statistics</h3>

                @if($game->stats && count($game->stats) >= 2)
                    @php
                        $homeStats = collect($game->stats[0]['statistics']);
                        $awayStats = collect($game->stats[1]['statistics']);
                    @endphp

                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($homeStats as $index => $stat)
                            @php
                                $type = $stat['type'];
                                $homeVal = (float)($stat['value'] ?? 0);
                                $awayVal = (float)($awayStats->where('type', $type)->first()['value'] ?? 0);

                                // Calculate total to determine the percentage spread
                                $total = $homeVal + $awayVal;

                                // Handle division by zero and default to 50/50 if no data exists
                                $homePercent = ($total > 0) ? ($homeVal / $total) * 100 : 50;
                                $awayPercent = ($total > 0) ? ($awayVal / $total) * 100 : 50;
                            @endphp

                            <div style="margin-bottom: 12px;">
                                <div
                                    style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 4px;">
                                    <span style="color: var(--sky-dark);">{{ $stat['value'] ?? 0 }}</span>
                                    <span
                                        style="color: var(--text-muted); text-transform: uppercase; font-size: 10px;">{{ $type }}</span>
                                    <span style="color: var(--pink-dark);">{{ $awayVal }}</span>
                                </div>

                                <div
                                    style="display: flex; height: 6px; background: #eee; border-radius: 3px; overflow: hidden;">
                                    <div
                                        style="width: {{ $homePercent }}%; background: var(--sky-dark); border-right: 1px solid white; transition: width 0.5s ease;"></div>
                                    <div
                                        style="width: {{ $awayPercent }}%; background: var(--pink-dark); transition: width 0.5s ease;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="text-align: center; color: var(--text-muted);">Stats available at full time.</p>
                @endif
            </div>

            <div style="padding: 24px; background: #fafafa;">
                <h3 style="font-size: 14px; text-transform: uppercase; color: var(--text-muted); margin-bottom: 16px;">Social Feed</h3>
                <div style="padding: 24px; background: #fafafa;">
                    <h3 style="font-size: 14px; text-transform: uppercase; color: var(--text-muted); margin-bottom: 16px;">Social Feed</h3>

                    @auth
                        <form action="{{ route('comments.store', $game->id) }}" method="POST" style="margin-bottom: 24px;">
                            @csrf
                            <textarea name="content" placeholder="What are your thoughts on this match?"
                                      style="width: 100%; border: 1px solid var(--border); border-radius: 12px; padding: 12px; font-family: inherit; resize: none; outline: none; font-size: 13px;"
                                      rows="3" required></textarea>
                            <button type="submit" style="background: var(--sky-dark); color: white; border: none; padding: 10px 20px; border-radius: 20px; margin-top: 8px; cursor: pointer; font-weight: 600; font-size: 12px;">
                                Post Comment
                            </button>
                        </form>
                    @else
                        <div style="background: var(--sky-light); padding: 16px; border-radius: 12px; font-size: 13px; margin-bottom: 20px; text-align: center;">
                            <p style="margin-bottom: 8px;">Want to join the discussion?</p>
                            <a href="{{ route('login') }}" style="color: var(--sky-dark); font-weight: 700; text-decoration: none;">Log in</a> or
                            <a href="{{ route('register') }}" style="color: var(--pink-dark); font-weight: 700; text-decoration: none;">Register</a>
                        </div>
                    @endauth

                    <div class="comments-list" style="display: flex; flex-direction: column; gap: 16px;">
                        @forelse($game->comments->sortByDesc('created_at') as $comment)
                            <div style="display: flex; gap: 12px; align-items: flex-start;">
                                <div style="width: 36px; height: 36px; background: var(--sky-mid); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0;">
                                    {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                                </div>
                                <div style="background: white; border: 1px solid var(--border); padding: 12px; border-radius: 0 16px 16px 16px; flex: 1; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                                        <span style="font-size: 12px; font-weight: 700; color: var(--sky-dark);">{{ $comment->user->name }}</span>
                                        <span style="font-size: 10px; color: var(--text-muted);">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p style="font-size: 13px; margin: 0; line-height: 1.4;">{{ $comment->content }}</p>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; color: var(--text-muted); font-size: 13px; margin-top: 20px;">
                                No comments yet. Be the first to speak up!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
