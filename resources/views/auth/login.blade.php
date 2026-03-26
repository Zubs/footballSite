<x-guest-layout>
    <x-auth-session-status style="margin-bottom: 16px; color: var(--pink-dark); font-size: 14px;"
                           :status="session('status')"/>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="margin-bottom: 20px;">
            <label for="email"
                   style="display: block; font-size: 13px; font-weight: 600; color: var(--text-muted); margin-bottom: 8px;">
                {{ __('Email Address') }}
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   autocomplete="username"
                   style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 12px; font-family: inherit; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('email')"
                           style="margin-top: 8px; color: var(--pink-dark); font-size: 12px;"/>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password"
                   style="display: block; font-size: 13px; font-weight: 600; color: var(--text-muted); margin-bottom: 8px;">
                {{ __('Password') }}
            </label>
            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 12px; font-family: inherit; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password')"
                           style="margin-top: 8px; color: var(--pink-dark); font-size: 12px;"/>
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
            <label for="remember_me" style="display: flex; align-items: center; cursor: pointer;">
                <input id="remember_me" type="checkbox" name="remember"
                       style="width: 16px; height: 16px; accent-color: var(--sky-dark); cursor: pointer;">
                <span
                    style="margin-left: 8px; font-size: 13px; color: var(--text-muted);">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   style="font-size: 13px; color: var(--pink-dark); text-decoration: none; font-weight: 500;">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div style="display: flex; flex-direction: column; gap: 12px;">
            <button type="submit"
                    style="width: 100%; background: var(--sky-dark); color: white; padding: 14px; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 14px; transition: opacity 0.2s;">
                {{ __('Log in') }}
            </button>

            <p style="text-align: center; font-size: 13px; color: var(--text-muted); margin: 0;">
                Don't have an account?
                <a href="{{ route('register') }}"
                   style="color: var(--sky-dark); font-weight: 700; text-decoration: none;">Register here</a>
            </p>
        </div>
    </form>
</x-guest-layout>
