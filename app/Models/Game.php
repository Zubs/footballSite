<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    /**
     * @var \Illuminate\Support\HigherOrderCollectionProxy|mixed
     */
    protected $fillable = [
        'api_id', 'home_team_id', 'away_team_id', 'game_date',
        'status', 'score_home', 'score_away', 'venue',
        'last_synced_at',
        'lineups',
        'stats',
        'league_name',
        'league_country',
        'league_round',
        'season'
    ];

    protected $casts = [
        'lineups' => 'array',
        'stats' => 'array',
    ];

    // Relationships
    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
