<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/matches/{id}', [MatchController::class, 'show'])->name('matches.show');
