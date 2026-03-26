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
            padding: 0 16px;
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
            padding: 12px 16px;
            display: flex;
            flex-direction: column; /* Stack search and geo button for better mobile flow */
            gap: 12px;
            align-items: center;
            border-bottom: 1px solid var(--border);
        }

        .search-input {
            width: 100%; /* Make it take the full container width */
            max-width: 800px; /* But don't let it get ridiculously wide on ultra-wide screens */
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 12px 20px;
            font-size: 16px;
            outline: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            box-sizing: border-box;
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

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--sky-dark);
            cursor: pointer;
        }

        /* Match Detail Grid System */
        .detail-grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr 350px;
            gap: 0;
            background: var(--surface);
            max-width: 1400px;
            margin: 20px auto;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .detail-column {
            padding: 24px;
            border-right: 1px solid var(--border);
        }

        .lineups-inner-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        /* Responsive Media Queries */
        @media (max-width: 1024px) {
            .detail-grid-container {
                grid-template-columns: 1fr; /* Stack columns on tablets/phones */
            }

            .detail-column {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }
        }

        @media (max-width: 768px) {
            /* Navigation Menu */
            .menu-toggle {
                display: block;
            }

            .nav-links, .nav-right {
                display: none; /* Hide by default on mobile */
                position: absolute;
                top: 56px;
                left: 0;
                width: 100%;
                background: var(--surface);
                flex-direction: column;
                padding: 20px;
                border-bottom: 1px solid var(--border);
                z-index: 100;
            }

            .nav-active {
                display: flex !important;
            }

            /* Hero Section */
            .detail-hero {
                padding: 24px 16px !important;
            }

            .detail-hero div[style*="gap: 40px"] {
                gap: 15px !important;
            }

            .detail-hero font-size[style*="56px"] {
                font-size: 32px !important;
            }

            /* Lineups */
            .lineups-inner-grid {
                grid-template-columns: 1fr; /* Stack home/away lineups */
            }
        }

        @media (max-width: 600px) {
            .nav-links {
                display: none; /* Hide extra links to save space or move to a burger menu */
            }

            .nav-brand {
                font-size: 18px; /* */
            }

            .search-input {
                font-size: 14px; /* Slightly smaller text for mobile */
                padding: 10px 16px;
            }
        }

        @media (max-width: 480px) {
            .match-card {
                padding: 12px 8px;
                gap: 8px;
                grid-template-columns: 1.2fr 1fr 1.2fr; /* Give teams slightly more space */
            }

            .team-name {
                font-size: 12px; /* */
            }

            .team-badge-img {
                width: 24px;
                height: 24px; /* */
            }

            .score-big {
                font-size: 18px; /* */
            }

            .score-center {
                min-width: 60px; /* */
            }

            .score-status, .score-time {
                font-size: 10px; /* */
            }
        }

        /* Update these in your <style> block */

        .nav {
            position: relative; /* Essential for absolute mobile menu */
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 64px;
            z-index: 1000; /* Keeps menu above search bar */
        }

        .nav-menu-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-grow: 1;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block; /* Hamburger becomes visible */
            }

            .nav-menu-container {
                display: none; /* Hidden until toggled */
                position: absolute;
                top: 64px; /* Directly below the nav bar */
                left: 0;
                width: 100%;
                background: var(--surface);
                flex-direction: column;
                padding: 20px 0;
                border-bottom: 2px solid var(--sky);
                box-shadow: 0 10px 15px rgba(0,0,0,0.05);
            }

            .nav-menu-container.active {
                display: flex; /* Shown when toggled */
            }

            .nav-links, .nav-right {
                display: flex; /* Ensure these are flex on mobile */
                flex-direction: column;
                width: 100%;
                align-items: center;
                gap: 16px;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
<nav class="nav">
    <div class="nav-brand">
        <span style="width:8px;height:8px;background:var(--pink-mid);border-radius:50%;"></span>
        FootballSite
    </div>

    <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle Menu">☰</button>

    <div class="nav-menu-container" id="navMenu">
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Matches</a>
            <a href="/about" class="nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
        </div>

        <div class="nav-right">
            @auth
                <span class="nav-user-label"
                      style="font-size: 14px; font-weight: 600; color: var(--sky-dark); margin-right: 10px;">
                    {{ Auth::user()->name }}
                </span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link"
                            style="background: none; border: none; cursor: pointer; padding: 0;">
                        Log Out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                <a href="{{ route('register') }}" class="btn-login"
                   style="text-decoration: none; background: var(--sky-dark); color: white; padding: 6px 16px; border-radius: 20px; font-size: 14px;">Register</a>
            @endauth
        </div>
    </div>
</nav>

<form action="{{ route('home') }}" method="GET" id="globalSearchForm">
    <div class="search-strip">
        <input type="text" name="term" id="teamSearch" class="search-input"
               placeholder="🔍 Search by team name..."
               value="{{ request('term') }}">
        <button type="button" class="geo-btn" onclick="getLocation()">📍 Matches near me</button>
    </div>
</form>

<main>
    @yield('content')
</main>

<script>
    function toggleMenu() {
        const menu = document.getElementById('navMenu');
        menu.classList.toggle('active');
    }

    function updateContent(url) {
        const contentArea = document.querySelector('.content');
        const dateNavArea = document.querySelector('.date-nav');

        if (!contentArea) {
            return
        }

        // Show a simple loading state (UX boost)
        contentArea.style.opacity = '0.5';

        fetch(url, {
            headers: {"X-Requested-With": "XMLHttpRequest"}
        })
            .then(response => response.json())
            .then(data => {
                contentArea.innerHTML = data.matchListHtml;

                if (dateNavArea) {
                    dateNavArea.innerHTML = data.dateNavHtml;
                }

                contentArea.style.opacity = '1';
                window.history.pushState({}, '', url);
            })
            .catch(error => console.error('Error:', error));
    }

    function getLocation() {
        if (navigator.geolocation) {
            const geoBtn = document.querySelector('.geo-btn');
            const originalText = geoBtn.innerText;
            geoBtn.innerText = "🔍 Locating...";

            navigator.geolocation.getCurrentPosition(position => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;

                // Reverse Geocode using BigDataCloud (Free, no API key needed for basic usage)
                fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=en`)
                    .then(res => res.json())
                    .then(data => {
                        const cleanCountry = data.principalSubdivision || data.countryName;
                        const url = `{{ route('home') }}?country=${encodeURIComponent(cleanCountry)}`;
                        updateContent(url);

                        geoBtn.innerText = `📍 Matches in ${cleanCountry}`;
                    })
                    .catch(error => {
                        console.error('Error fetching country:', error);
                        geoBtn.innerText = originalText;
                    });
            }, () => {
                alert("Location access denied.");
                geoBtn.innerText = originalText;
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // --- Search Listener (with Debounce) ---
        let searchTimer;
        document.getElementById('teamSearch').addEventListener('input', function (e) {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                const term = e.target.value;
                const url = `{{ route('home') }}?term=${term}`;
                updateContent(url);
            }, 300); // Wait 300ms after typing stops to save API/DB load
        });

        // --- Date Arrow Listener ---
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('date-arrow') || e.target.closest('.date-arrow')) {
                e.preventDefault();
                const anchor = e.target.tagName === 'A' ? e.target : e.target.closest('a');
                if (anchor) updateContent(anchor.href);
            }
        });
    });
</script>
</body>
</html>
