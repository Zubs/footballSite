<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = ['api_id', 'name', 'tla', 'crest_url', 'country'];

    public function homeMatches(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team_id');
    }

    public function awayMatches(): HasMany
    {
        return $this->hasMany(Game::class, 'away_team_id');
    }
}
