@extends('layouts.auth')

@section('title', 'Create Account — AcademiaPro')

@section('speech-text')
    🎓 Join AcademiaPro!
@endsection

@section('form-content')

    @if($errors->any())
        <div class="alert-auth is-error" role="alert">
            Please fix the errors below to create your account.
        </div>
    @endif

    <h2 class="auth-heading">Create account</h2>
    <p class="auth-sub">Join AcademiaPro and start managing student records in seconds.</p>

    <form id="register-form" method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        {{-- Full name --}}
        <div class="auth-field">
            <label for="name">Full name</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                autocomplete="name"
                autofocus
                required
                class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                placeholder="Jane Doe"
            >
            @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="auth-field">
            <label for="email">Email address</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email"
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
                autocomplete="new-password"
                required
                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                placeholder="Min. 8 characters"
            >
            @error('password')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

        {{-- Confirm password --}}
        <div class="auth-field">
            <label for="password_confirmation">Confirm password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                autocomplete="new-password"
                required
                placeholder="Repeat your password"
            >
        </div>

        <button id="register-submit" type="submit" class="btn-auth" style="margin-top:6px">
            Create account &rarr;
        </button>
    </form>

    <div class="auth-divider" style="margin-top:22px">or</div>

    <p class="auth-switch" style="margin-top:0">
        Already have an account?
        <a href="{{ route('login') }}">Sign in &rarr;</a>
    </p>

@endsection
