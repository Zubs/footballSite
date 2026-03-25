<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Site</title>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --sky: #B8D8F0;
            --sky-light: #E8F4FC;
            --sky-mid: #7AB8E0;
            --sky-dark: #3A7CAC;
            --pink: #F2C4D0;
            --pink-light: #FDF0F3;
            --pink-mid: #E88FA4;
            --pink-dark: #C45472;
            --text: #1A2B3C;
            --text-muted: #6B7E8F;
            --surface: #FFFFFF;
            --page-bg: #F0F6FB;
            --border: rgba(58, 124, 172, 0.15);
            --radius: 16px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--page-bg);
            color: var(--text);
            margin: 0;
        }

        /* Nav & Search */
        .nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 56px;
        }

        .nav-brand {
            font-family: 'DM Serif Display', serif;
            font-size: 20px;
            color: var(--sky-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 14px;
            margin: 0 10px;
        }

        .search-strip {
            background: var(--sky-light);
            padding: 14px 24px;
            display: flex;
            gap: 10px;
            align-items: center;
            border-bottom: 1px solid var(--border);
        }

        .search-input {
            flex: 1;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 9px 16px;
            max-width: 320px;
            outline: none;
        }

        /* Date Nav */
        .date-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 24px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }

        .date-arrow {
            text-decoration: none;
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            border-radius: 50%;
            background: var(--sky-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sky-dark);
        }

        .date-label {
            font-weight: 500;
        }

        .date-today {
            font-size: 12px;
            color: var(--sky-dark);
            background: var(--sky-light);
            padding: 3px 10px;
            border-radius: 12px;
        }

        /* Content & Cards */
        .content {
            padding: 20px 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            margin-top: 20px;
        }

        .section-title {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .match-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px;
            margin-bottom: 12px;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 12px;
            transition: transform 0.2s;
        }

        .match-card:hover {
            border-color: var(--sky-mid);
            transform: translateY(-2px);
        }

        .team-name {
            font-size: 14px;
            font-weight: 500;
        }

        .team-side.right {
            text-align: right;
        }

        .score-center {
            text-align: center;
            min-width: 80px;
        }

        .score-big {
            font-family: 'DM Serif Display', serif;
            font-size: 22px;
            line-height: 1;
        }

        .score-status {
            font-size: 10px;
            color: var(--text-muted);
            font-weight: 700;
            margin-top: 4px;
        }

        .score-time {
            font-size: 13px;
            color: var(--sky-dark);
            font-weight: 600;
            background: var(--sky-light);
            padding: 4px 12px;
            border-radius: 20px;
        }

        .geo-btn {
            background: var(--pink-light);
            border: 1px solid var(--pink);
            color: var(--pink-dark);
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 500;
        }

        .team-badge-img {
            width: 32px;
            height: 32px;
            object-fit: contain;
            margin-bottom: 4px;
        }
        .team-side {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .team-side.right {
            align-items: flex-end;
        }
    </style>
</head>
<body>
<nav class="nav">
    <div class="nav-brand"><span style="width:8px;height:8px;background:var(--pink-mid);border-radius:50%;"></span>
        FootballSite
    </div>
    <div class="nav-links">
        <a href="{{ route('home') }}" class="nav-link active">Matches</a>
        <a href="/about" class="nav-link">About</a>
    </div>
    <div class="nav-right">
        @auth
            <span class="nav-link">{{ Auth::user()->name }}</span>
        @else
            <a href="/login" class="btn-login">Log in</a>
        @endauth
    </div>
</nav>

<div class="search-strip">
    <input type="text" id="teamSearch" class="search-input" placeholder="🔍 Search by team name...">
    <button class="geo-btn" onclick="getLocation()">📍 Matches near me</button>
</div>

<main>
    @yield('content')
</main>

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                alert("Lat: " + pos.coords.latitude + " Lon: " + pos.coords.longitude);
            });
        }
    }
</script>
</body>
</html>
