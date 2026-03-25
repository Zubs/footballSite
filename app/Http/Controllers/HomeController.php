<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Services\FootballApiService;
use Carbon\Carbon;
use Throwable;

class HomeController extends Controller
{
    protected FootballApiService $apiService;

    public function __construct(FootballApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display the daily match list.
     * @throws ConnectionException|Throwable
     */
    public function index(Request $request)
    {
        $dateString = $request->query('date', Carbon::today()->format('Y-m-d'));
        $date = Carbon::parse($dateString);
        $games = Game::whereDate('game_date', $date)->get();

        if ($games->isEmpty()) {
            $this->apiService->syncMatches($dateString);

            $games = Game::whereDate('game_date', $date)->get();
        }

        $completed = $games->whereIn('status', ['FINISHED', 'AWARDED']);
        $upcoming = $games->whereNotIn('status', ['FINISHED', 'AWARDED']);

        if ($request->ajax()) {
            return view('partials.match-list', compact('completed', 'upcoming', 'date'))->render();
        }

        return view('home', compact('completed', 'upcoming', 'date'));
    }
}
