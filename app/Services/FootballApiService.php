<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use App\Models\Team;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FootballApiService
{
    protected string $baseUrl = 'https://v3.football.api-sports.io/';
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.football_data.key');
    }

    /**
     * Sync matches using API-Football v3 logic.
     * Maps 'fixtures' to our 'Game' model.
     * @throws ConnectionException
     */
    public function syncMatches($date = null): bool
    {
        $date = $date ?: Carbon::today()->format('Y-m-d');

        $response = Http::withHeaders([
            'x-apisports-key' => $this->apiKey,
            'x-rapidapi-host' => 'v3.football.api-sports.io'
        ])->get($this->baseUrl . 'fixtures', [
            'date' => $date
        ]);

        if ($response->successful()) {
            $data = $response->json();

            foreach ($data['response'] as $item) {
                $fixture = $item['fixture'];
                $teams = $item['teams'];
                $goals = $item['goals'];

                $homeTeam = Team::updateOrCreate(
                    ['api_id' => $teams['home']['id']],
                    [
                        'name' => $teams['home']['name'],
                        'crest_url' => $teams['home']['logo'],
                        'tla' => Str::upper(Str::limit(preg_replace('/[^A-Za-z0-9]/', '', $teams['home']['name']), 3, ''))
                    ]
                );

                $awayTeam = Team::updateOrCreate(
                    ['api_id' => $teams['away']['id']],
                    [
                        'name' => $teams['away']['name'],
                        'crest_url' => $teams['away']['logo'],
                        'tla' => Str::upper(Str::limit(preg_replace('/[^A-Za-z0-9]/', '', $teams['home']['name']), 3, ''))
                    ]
                );

                Game::updateOrCreate(
                    ['api_id' => $fixture['id']],
                    [
                        'home_team_id' => $homeTeam->id,
                        'away_team_id' => $awayTeam->id,
                        'game_date' => Carbon::parse($fixture['date']),
                        'status' => $this->mapStatus($fixture['status']['short']),
                        'score_home' => $goals['home'] ?? 0,
                        'score_away' => $goals['away'] ?? 0,
                        'venue' => $fixture['venue']['name'] ?? 'Unknown Stadium',
                        'last_synced_at' => now(),
                    ]
                );
            }

            return true;
        }

        return false;
    }

    /**
     * Maps API-Football short codes to your ENUM.
     */
    private function mapStatus($shortStatus): string
    {
        $map = [
            'FT' => 'FINISHED',
            'NS' => 'SCHEDULED',
            '1H' => 'LIVE',
            '2H' => 'LIVE',
            'HT' => 'PAUSED',
            'PST' => 'POSTPONED',
            'CANC' => 'CANCELLED'
        ];

        return $map[$shortStatus] ?? 'SCHEDULED';
    }

    /**
     * Fetch and store lineups, substitutes, and managers.
     * @throws ConnectionException
     */
    public function syncLineups($game): void
    {
        $response = Http::withHeaders([
            'x-apisports-key' => $this->apiKey,
            'x-rapidapi-host' => 'v3.football.api-sports.io'
        ])->get($this->baseUrl . 'fixtures/lineups', ['fixture' => $game->api_id]);

        if ($response->successful()) {
            // This stores the 'response' array which contains startXI, substitutes, and coach
            $game->update(['lineups' => $response->json()['response']]);
        }
    }

    /**
     * Fetch and store match statistics (Possession, Shots, etc.)
     */
    public function syncStats($game): void
    {
        $response = Http::withHeaders([
            'x-apisports-key' => $this->apiKey,
            'x-rapidapi-host' => 'v3.football.api-sports.io'
        ])->get($this->baseUrl . 'fixtures/statistics', ['fixture' => $game->api_id]);

        if ($response->successful()) {
            $game->update(['stats' => $response->json()['response']]);
        }
    }
}
