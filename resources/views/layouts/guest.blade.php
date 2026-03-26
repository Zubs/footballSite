<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FootballSite — Join the Conversation</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=DM+Serif+Display&display=swap"
          rel="stylesheet">

    <style>
        :root {
            --sky-light: #E8F4FC;
            --sky-dark: #3A7CAC;
            --pink-dark: #C45472;
            --text: #1A2B3C;
            --surface: #FFFFFF;
            --page-bg: #F0F6FB;
            --border: rgba(58, 124, 172, 0.15);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--page-bg);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .auth-card {
            background: var(--surface);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 25px rgba(58, 124, 172, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .auth-logo {
            font-family: 'DM Serif Display', serif;
            font-size: 28px;
            color: var(--sky-dark);
            text-align: center;
            margin-bottom: 30px;
            text-decoration: none;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid var(--border);
            border-radius: 12px;
            outline: none;
        }

        button {
            width: 100%;
            background: var(--sky-dark);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        button:hover {
            opacity: 0.9;
        }

        .auth-link {
            color: var(--pink-dark);
            font-size: 13px;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="auth-card">
    <a href="/" class="auth-logo">FootballSite</a>
    {{ $slot }}
</div>
</body>
</html>
