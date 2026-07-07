# FootballSite ⚽

A dynamic, full-stack football match tracking and fan engagement web application, built as coursework for the **6CC001 Advanced Web Technologies** module at the **University of Wolverhampton**.

> 🏆 **Grade: 100/100**

## Overview

FootballSite lets fans browse daily football fixtures, drill into detailed match statistics and lineups, and discuss games with other registered users. It integrates a live third-party football data API, supports AJAX-driven browsing without full page reloads, and uses the browser's Geolocation API to surface matches relevant to the user's location.

## Features

- **Daily match dashboard** — browse fixtures by date, split into completed and upcoming matches, with live status indicators (LIVE, FT, scheduled, postponed, cancelled).
- **Live API sync** — fixtures, lineups, and statistics are pulled from the [API-Football](https://www.api-football.com/) (v3) service and cached in the database, refreshing automatically for recent/live match days.
- **Match detail pages** — starting XIs, substitutes, managers, and a possession/shots/cards statistics breakdown rendered as comparative bars.
- **AJAX search & date navigation** — searching by team name or paging between dates updates the match list in place via `fetch`, with debounced input handling.
- **Geolocation-aware filtering** — a "Matches near me" button uses the browser Geolocation API plus reverse geocoding to filter fixtures by the user's country.
- **User accounts** — registration, login, email verification, password reset/update, and account deletion (built on Laravel Breeze scaffolding).
- **Social comments** — authenticated users can post comments on any match, displayed in a live-updating discussion feed.
- **Responsive design** — custom CSS with fluid layouts and breakpoints for mobile, tablet, and desktop, including a collapsible mobile navigation menu.

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2, Laravel 12 |
| Database | MySQL (SQLite for local/testing) |
| Frontend | Blade templates, vanilla JavaScript (Fetch API), Alpine.js |
| Styling | Custom CSS with CSS variables, Tailwind (auth scaffolding) |
| External API | API-Football v3 (fixtures, lineups, statistics) |
| Auth | Laravel Breeze |
| Testing | PHPUnit (Feature & Unit tests) |
| Hosting | University student server (`mi-linux.wlv.ac.uk`) |

## Project Structure

```
app/
  Http/Controllers/       # HomeController, MatchController, CommentController, ProfileController, Auth/*
  Models/                 # Game, Team, Comment, User
  Services/               # FootballApiService — handles all API-Football integration
resources/views/
  home.blade.php          # Match dashboard
  match-detail.blade.php  # Lineups, stats, comments
  partials/               # AJAX-refreshed date-nav and match-list partials
  auth/                   # Login, register, password reset views
database/migrations/      # Schema for teams, games, comments, users
routes/web.php            # Public + authenticated routes
routes/auth.php           # Breeze authentication routes
```

## Key Implementation Details

- **`FootballApiService`** centralises all outbound calls to API-Football, mapping the API's fixture status codes to a local `ENUM` (`SCHEDULED`, `LIVE`, `FINISHED`, etc.) and upserting teams/games via `updateOrCreate` to avoid duplicate records on repeated syncs.
- **`HomeController@index`** only re-syncs fixtures from the API when the requested day is today/yesterday and the last sync was more than 10 minutes ago, minimising unnecessary external API calls while keeping live scores current.
- Match lineups and statistics are fetched **lazily**, on first visit to a match's detail page, and cached as JSON columns (`lineups`, `stats`) on the `games` table.
- AJAX requests are detected server-side via `$request->ajax()`, returning rendered partial HTML (match list + date nav) as JSON so the same controller serves both full page loads and in-place updates.

## Getting Started

```bash
git clone <repository-url>
cd footballsite
composer install
npm install

cp .env.example .env
php artisan key:generate
```

Configure your database and API credentials in `.env`:

```env
DB_CONNECTION=mysql
DB_DATABASE=footballsite
DB_USERNAME=root
DB_PASSWORD=

FOOTBALL_DATA_API_KEY=your_api_football_key
```

Run migrations and start the app:

```bash
php artisan migrate
npm run build   # or `npm run dev` for local development
php artisan serve
```

## Running Tests

```bash
composer test
```

## Module Context

This project was submitted for **Assessment 1** of 6CC001 Advanced Web Technologies (Semester 2, 2025–2026), worth 50% of the module mark. The brief required a dynamic PHP/MySQL website (framework of choice) hosted on the university's student server, demonstrating the modern web development techniques covered in lectures — dynamic server-side scripting, database-driven content, AJAX, and integration with browser/device APIs. Content management systems such as WordPress were explicitly disallowed.

## Author

Zubair — Module Leader: Alix Bergeret
