<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sign in to AcademiaPro Student Management System">
    <title>Login — AcademiaPro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Login page overrides ── */
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; }

        .login-wrap {
            position: relative; z-index: 1;
            width: 100%; max-width: 440px;
            padding: 40px 36px 36px;
            background: #0e0b09;
            border: 1px solid var(--border);
            border-radius: 24px 32px 26px 30px;
            box-shadow: var(--shadow), 0 0 80px rgba(255,90,31,.08);
            animation: slideUp .45s cubic-bezier(.22,1,.36,1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-brand {
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 32px;
        }
        .login-brand-mark {
            display: grid; place-items: center;
            width: 46px; height: 46px;
            background: var(--primary); color: #1b120d;
            font-weight: 800; font-size: 1.2rem;
            border: 2px solid #ff8b61;
            border-radius: 48% 52% 44% 56% / 57% 43% 57% 43%;
            box-shadow: var(--shadow);
            flex-shrink: 0;
        }
        .login-brand h1 { margin: 0; font-size: 1.25rem; }
        .login-brand p  { margin: 2px 0 0; font-size: .72rem; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; }

        .login-heading { margin: 0 0 6px; font-size: 1.55rem; }
        .login-sub     { margin: 0 0 28px; color: var(--muted); font-size: .9rem; }

        .login-field   { display: flex; flex-direction: column; gap: 7px; margin-bottom: 18px; }
        .login-field label { font-size: .8rem; font-weight: 600; color: var(--muted); letter-spacing: .05em; text-transform: uppercase; }
        .login-field input {
            width: 100%; min-height: 48px; padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 12px 16px 11px 17px;
            outline: none;
            background: rgba(10,7,5,.55); color: var(--text);
            transition: border-color .2s ease, box-shadow .2s ease;
            font-size: 1rem;
        }
        .login-field input:focus {
            border-color: rgba(255,90,31,.8);
            box-shadow: 0 0 0 3px rgba(255,90,31,.18);
        }
        .login-field input.is-invalid { border-color: rgba(255,119,97,.7); }

        .invalid-feedback { margin-top: 6px; font-size: .8rem; color: var(--danger); }

        .login-remember {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 24px; color: var(--muted); font-size: .88rem;
        }
        .login-remember input[type="checkbox"] { accent-color: var(--primary); width: 16px; height: 16px; cursor: pointer; }

        .btn-login {
            width: 100%; min-height: 50px;
            background: var(--primary); color: #21120b;
            border: none; border-radius: 12px 16px 11px 17px;
            font-weight: 800; font-size: 1rem; cursor: pointer;
            box-shadow: 4px 5px 0 #8f260e;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .btn-login:hover {
            transform: translate(-2px,-2px) rotate(-.4deg);
            box-shadow: 9px 10px 0 #8f260e;
        }
        .btn-login:active { transform: translate(1px,1px); box-shadow: 2px 3px 0 #8f260e; }

        .alert-login {
            margin-bottom: 20px; padding: 13px 15px;
            border-radius: 12px 16px 11px 17px;
            border: 1px solid rgba(248,160,34,.3);
            background: rgba(248,160,34,.1); color: #ffe5b9;
            font-size: .88rem;
        }
        .alert-login.is-error {
            border-color: rgba(255,119,97,.28);
            background: rgba(255,119,97,.1); color: #ffd9d1;
        }
    </style>
</head>
<body>
    {{-- Background doodles (matches main layout) --}}
    <div class="doodle doodle-sun" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
    <div class="doodle doodle-squiggle" aria-hidden="true">~</div>
    <div class="doodle doodle-star" aria-hidden="true">✦</div>

    <div class="login-wrap" role="main">

        {{-- Brand --}}
        <div class="login-brand">
            <div class="login-brand-mark" aria-hidden="true">A</div>
            <div>
                <p>Academic Suite</p>
                <h1>AcademiaPro</h1>
            </div>
        </div>

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="alert-login" role="alert">{{ session('success') }}</div>
        @endif

        <h2 class="login-heading">Welcome back</h2>
        <p class="login-sub">Sign in to manage your student records.</p>

        <form id="login-form" method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            {{-- Email --}}
            <div class="login-field">
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
            <div class="login-field">
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
            <label class="login-remember" for="remember">
                <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Keep me signed in
            </label>

            <button id="login-submit" type="submit" class="btn-login">Sign in →</button>
        </form>
    </div>
</body>
</html>
