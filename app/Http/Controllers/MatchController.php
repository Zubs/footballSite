<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Services\FootballApiService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class MatchController extends Controller
{
    protected FootballApiService $apiService;

    public function __construct(FootballApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @throws ConnectionException
     */
    public function show($id)
    {
        $game = Game::with(['homeTeam', 'awayTeam', 'comments.user'])->findOrFail($id);

        if (!$game->lineups) {
            $this->apiService->syncLineups($game);
        }

        if (!$game->stats) {
            $this->apiService->syncStats($game);
        }

        return view('match-detail', compact('game'));
    }
}
