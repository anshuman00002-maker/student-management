@extends('layouts.auth')

@section('title', 'Sign In — AcademiaPro')

@section('speech-text')
    @if(session('success'))
        👋 See you next time!
    @else
        👋 Welcome back!
    @endif
@endsection

@section('form-content')

    @if(session('success'))
        <div class="alert-auth" role="alert">{{ session('success') }}</div>
    @endif

    <h2 class="auth-heading">Welcome back</h2>
    <p class="auth-sub">Sign in to access your student management portal.</p>

    <form id="login-form" method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        {{-- Email --}}
        <div class="auth-field">
            <label for="email">Email address</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email"
                autofocus
                required
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                placeholder="you@example.com"
            >
            @error('email')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="auth-field">
            <label for="password">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                autocomplete="current-password"
                required
                placeholder="••••••••"
            >
            @error('password')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

        {{-- Remember me --}}
        <label class="auth-check" for="remember">
            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            Keep me signed in
        </label>

        <button id="login-submit" type="submit" class="btn-auth">Sign in &rarr;</button>
    </form>

    <div class="auth-divider" style="margin-top:22px">or</div>

    <p class="auth-switch" style="margin-top:0">
        Don't have an account?
        <a href="{{ route('register') }}">Create one free &rarr;</a>
    </p>

@endsection
