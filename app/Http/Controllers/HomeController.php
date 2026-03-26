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
        $dateString = $request->query('date', now()->format('Y-m-d'));
        $term = $request->query('term');
        $country = $request->query('country');
        $date = Carbon::parse($dateString);
        $dayExists = Game::whereDate('game_date', $date)->exists();

        if (!$dayExists && !$term && !$country) {
            $this->apiService->syncMatches($dateString);
        }

        $query = Game::with(['homeTeam', 'awayTeam'])->whereDate('game_date', $date);

        if ($term) {
            $query->where(function($q) use ($term) {
                $q->whereHas('homeTeam', fn($t) => $t->where('name', 'like', "%$term%"))
                    ->orWhereHas('awayTeam', fn($t) => $t->where('name', 'like', "%$term%"));
            });
        }

        if ($country) {
            $query->whereHas('homeTeam', function($q) use ($country) {
                $q->where('country', '=', $country);
            });
        }

        $games = $query->get();
        $completed = $games->whereIn('status', ['FINISHED', 'AWARDED']);
        $upcoming = $games->whereNotIn('status', ['FINISHED', 'AWARDED']);

        if ($request->ajax()) {
            return response()->json([
                'matchListHtml' => view('partials.match-list', compact('completed', 'upcoming'))->render(),
                'dateNavHtml' => view('partials.date-nav', compact('date', 'term', 'country'))->render(),
            ]);
        }

        return view('home', compact('completed', 'upcoming', 'date', 'term', 'country'));
    }
}
