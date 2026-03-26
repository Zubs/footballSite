<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div style="margin-bottom: 20px;">
            <label for="name"
                   style="display: block; font-size: 13px; font-weight: 600; color: var(--text-muted); margin-bottom: 8px;">
                {{ __('Full Name') }}
            </label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   autocomplete="name"
                   style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 12px; font-family: inherit; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('name')"
                           style="margin-top: 8px; color: var(--pink-dark); font-size: 12px;"/>
        </div>

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
                   autocomplete="new-password"
                   style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 12px; font-family: inherit; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password')"
                           style="margin-top: 8px; color: var(--pink-dark); font-size: 12px;"/>
        </div>

        <div style="margin-bottom: 24px;">
            <label for="password_confirmation"
                   style="display: block; font-size: 13px; font-weight: 600; color: var(--text-muted); margin-bottom: 8px;">
                {{ __('Confirm Password') }}
            </label>
            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required
                   autocomplete="new-password"
                   style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 12px; font-family: inherit; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password_confirmation')"
                           style="margin-top: 8px; color: var(--pink-dark); font-size: 12px;"/>
        </div>

        <div style="display: flex; flex-direction: column; gap: 12px;">
            <button type="submit"
                    style="width: 100%; background: var(--sky-dark); color: white; padding: 14px; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 14px; transition: opacity 0.2s;">
                {{ __('Create Account') }}
            </button>

            <p style="text-align: center; font-size: 13px; color: var(--text-muted); margin: 0;">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" style="color: var(--sky-dark); font-weight: 700; text-decoration: none;">Log
                    in here</a>
            </p>
        </div>
    </form>
</x-guest-layout>
