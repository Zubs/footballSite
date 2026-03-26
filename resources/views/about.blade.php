@extends('layouts.app')

@section('content')
    <div style="max-width: 800px; margin: 20px auto; padding: 0 16px;">
        <h1 style="font-family: 'DM Serif Display', serif; color: var(--sky-dark); font-size: clamp(24px, 5vw, 32px); margin-bottom: 24px;">
            About FootballSite
        </h1>

        <div
            style="background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: clamp(16px, 4vw, 32px); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
            <p style="line-height: 1.6; margin-bottom: 20px; font-size: clamp(14px, 3.5vw, 16px);">
                <strong>FootballSite</strong> is a high-performance web application developed for the <strong>6CC001
                    Advanced Web Technologies</strong> module. It provides real-time match tracking, dynamic statistics,
                and a social engagement platform for football fans.
            </p>

            <h3 style="font-size: 16px; color: var(--sky-dark); text-transform: uppercase; margin-top: 30px; margin-bottom: 15px;">
                Technical Stack</h3>

            <ul style="list-style: none; padding: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <li style="padding-left: 25px; position: relative; font-size: 14px;">
                    <span style="position: absolute; left: 0; color: var(--pink-dark);">✔</span>
                    <strong>Backend:</strong> Laravel 11 (PHP)
                </li>
                <li style="padding-left: 25px; position: relative; font-size: 14px;">
                    <span style="position: absolute; left: 0; color: var(--pink-dark);">✔</span>
                    <strong>Database:</strong> MySQL
                </li>
                <li style="padding-left: 25px; position: relative; font-size: 14px;">
                    <span style="position: absolute; left: 0; color: var(--pink-dark);">✔</span>
                    <strong>RIA:</strong> Vanilla JS / Fetch API
                </li>
                <li style="padding-left: 25px; position: relative; font-size: 14px;">
                    <span style="position: absolute; left: 0; color: var(--pink-dark);">✔</span>
                    <strong>API:</strong> API-Football (v3)
                </li>
            </ul>

            <h3 style="font-size: 16px; color: var(--sky-dark); text-transform: uppercase; margin-top: 30px; margin-bottom: 15px;">
                Core Features</h3>
            <p style="font-size: 14px; line-height: 1.6; color: var(--text-muted);">
                This application utilizes <strong>AJAX-driven date navigation</strong> and <strong>real-time
                    search</strong> to provide a seamless user experience without full-page reloads. It also leverages
                the <strong>Browser Geolocation API</strong> to prioritize local fixtures, demonstrating integration
                with modern hardware APIs.
            </p>

            <div
                style="margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border); font-size: 13px; color: var(--text-muted); display: flex; flex-wrap: wrap; gap: 8px;">
                <span>Developed by <strong>Zubair</strong></span>
                <span style="opacity: 0.5;">•</span>
                <span>Module Leader: <strong>Alix Bergeret</strong></span>
            </div>
        </div>
    </div>
@endsection
