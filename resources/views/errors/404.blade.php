@extends('layouts.app')

@section('content')
    <div
        style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 70vh; text-align: center; padding: 0 20px; box-sizing: border-box;">

        <div
            style="font-family: 'DM Serif Display', serif; font-size: clamp(80px, 20vw, 120px); color: var(--sky-mid); opacity: 0.5; line-height: 1;">
            404
        </div>

        <h1 style="font-family: 'DM Serif Display', serif; color: var(--sky-dark); font-size: clamp(24px, 6vw, 32px); margin-top: -10px; margin-bottom: 16px;">
            Offside! Page Not Found
        </h1>

        <p style="color: var(--text-muted); max-width: 450px; line-height: 1.6; margin-bottom: 30px; font-size: 14px;">
            It looks like the page you're looking for has moved or doesn't exist. Let's get you back into the game.
        </p>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; width: 100%;">
            <a href="{{ route('home') }}"
               style="background: var(--sky-dark); color: white; padding: 14px 28px; border-radius: 24px; text-decoration: none; font-weight: 600; font-size: 14px; transition: opacity 0.2s; min-width: 160px; box-sizing: border-box;">
                Back to Matches
            </a>
            <a href="{{ url()->previous() }}"
               style="background: var(--surface); color: var(--text); border: 1px solid var(--border); padding: 14px 28px; border-radius: 24px; text-decoration: none; font-weight: 600; font-size: 14px; min-width: 160px; box-sizing: border-box;">
                Go Back
            </a>
        </div>

        <div style="margin-top: 40px; font-size: 40px; opacity: 0.2;">
            🚩
        </div>
    </div>
@endsection
