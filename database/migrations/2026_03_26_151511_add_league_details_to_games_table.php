<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('league_name')->nullable()->after('venue');
            $table->string('league_country')->nullable()->after('league_name');
            $table->string('league_round')->nullable()->after('league_country');
            $table->integer('season')->nullable()->after('league_round');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn(['league_name', 'league_country', 'league_round', 'season']);
        });
    }
};
