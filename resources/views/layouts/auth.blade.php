<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AcademiaPro — Student Management Portal">
    <title>@yield('title', 'AcademiaPro')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Auth page base ── */
        body { margin: 0; display: flex; min-height: 100vh; overflow-x: hidden; }

        .auth-page {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* ── Left character panel ── */
        .auth-left {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 46%;
            padding: 48px 32px;
            background: radial-gradient(ellipse at 30% 20%, rgba(255,90,31,.18) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 80%, rgba(248,160,34,.12) 0%, transparent 55%),
                        #0a0704;
            border-right: 1px solid var(--border);
            overflow: hidden;
            gap: 28px;
        }

        /* Floating particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: var(--primary);
            animation: particleDrift var(--dur, 9s) ease-in-out infinite var(--delay, 0s);
            width: var(--size, 7px);
            height: var(--size, 7px);
            top: var(--top);
            left: var(--left);
            opacity: 0;
        }
        @keyframes particleDrift {
            0%   { transform: translate(0,0) scale(1);   opacity: 0; }
            15%  { opacity: .4; }
            50%  { transform: translate(var(--tx,20px), var(--ty,-40px)) scale(1.4); opacity: .25; }
            85%  { opacity: .15; }
            100% { transform: translate(var(--tx2,-15px), var(--ty2,-70px)) scale(.6); opacity: 0; }
        }

        /* Glowing ring behind character */
        .char-glow {
            position: absolute;
            width: 260px; height: 260px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,90,31,.12) 0%, transparent 70%);
            animation: glowPulse 3s ease-in-out infinite;
        }
        @keyframes glowPulse {
            0%,100% { transform: scale(1);   opacity: .7; }
            50%      { transform: scale(1.15); opacity: 1; }
        }

        /* Student SVG */
        .student-svg {
            width: 190px;
            height: auto;
            filter: drop-shadow(0 18px 36px rgba(255,90,31,.25));
            position: relative; z-index: 1;
        }

        /* Speech bubble */
        .speech-bubble {
            position: relative; z-index: 1;
            padding: 11px 22px;
            background: rgba(255,90,31,.14);
            border: 1.5px solid rgba(255,90,31,.45);
            border-radius: 22px 22px 22px 6px;
            color: var(--text);
            font-size: .98rem;
            font-weight: 700;
            white-space: nowrap;
            animation: bubbleFloat 3.2s ease-in-out infinite;
        }
        .speech-bubble::before {
            content: '';
            position: absolute;
            bottom: -13px; left: 16px;
            border: 7px solid transparent;
            border-top-color: rgba(255,90,31,.45);
        }
        .speech-bubble::after {
            content: '';
            position: absolute;
            bottom: -11px; left: 17px;
            border: 6px solid transparent;
            border-top-color: rgba(255,90,31,.14);
        }
        @keyframes bubbleFloat {
            0%,100% { transform: translateY(0) rotate(-.5deg); }
            50%      { transform: translateY(-8px) rotate(.5deg); }
        }

        /* Brand in left panel */
        .auth-brand {
            text-align: center;
            position: relative; z-index: 1;
        }
        .auth-brand-mark {
            display: inline-grid; place-items: center;
            width: 50px; height: 50px;
            background: var(--primary); color: #1b120d;
            font-weight: 800; font-size: 1.3rem;
            border: 2px solid #ff8b61;
            border-radius: 48% 52% 44% 56% / 57% 43% 57% 43%;
            box-shadow: var(--shadow);
            margin-bottom: 10px;
        }
        .auth-brand h1 { margin: 0; font-size: 1.35rem; }
        .auth-brand p  { margin: 3px 0 0; font-size: .72rem; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; }

        /* ── Right form panel ── */
        .auth-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            overflow-y: auto;
        }

        .auth-form-wrap {
            width: 100%;
            max-width: 430px;
            animation: slideInRight .5s cubic-bezier(.22,1,.36,1) both;
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(28px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ── Form typography ── */
        .auth-heading { margin: 0 0 5px; font-size: 1.9rem; letter-spacing: -.02em; }
        .auth-sub     { margin: 0 0 28px; color: var(--muted); font-size: .92rem; }

        /* ── Fields ── */
        .auth-field { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
        .auth-field label {
            font-size: .76rem; font-weight: 700; color: var(--muted);
            letter-spacing: .07em; text-transform: uppercase;
        }
        .auth-field input {
            width: 100%; min-height: 50px; padding: 13px 16px;
            border: 1.5px solid var(--border);
            border-radius: 12px 16px 11px 17px;
            outline: none;
            background: rgba(10,7,5,.6); color: var(--text);
            font-size: 1rem; font-family: inherit;
            transition: border-color .2s, box-shadow .2s, transform .15s;
        }
        .auth-field input:focus {
            border-color: rgba(255,90,31,.85);
            box-shadow: 0 0 0 3px rgba(255,90,31,.15);
            transform: translateY(-1px);
        }
        .auth-field input.is-invalid { border-color: rgba(255,119,97,.7); }
        .auth-field input::placeholder { color: rgba(200,181,161,.35); }

        .invalid-feedback {
            font-size: .8rem; color: var(--danger);
            display: flex; align-items: center; gap: 5px;
        }
        .invalid-feedback::before { content: '⚠'; font-size: .75rem; }

        /* Remember me */
        .auth-check {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 22px; color: var(--muted); font-size: .88rem;
            cursor: pointer;
        }
        .auth-check input { accent-color: var(--primary); width: 16px; height: 16px; cursor: pointer; }

        /* ── Submit button ── */
        .btn-auth {
            width: 100%; min-height: 52px;
            background: var(--primary); color: #21120b;
            border: none; border-radius: 12px 16px 11px 17px;
            font-weight: 800; font-size: 1.05rem; font-family: inherit;
            cursor: pointer;
            box-shadow: 5px 6px 0 #7a1e06;
            transition: transform .2s, box-shadow .2s;
            position: relative; overflow: hidden;
            letter-spacing: .01em;
        }
        .btn-auth::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,.18) 50%, transparent 100%);
            transform: translateX(-100%);
            transition: transform .55s ease;
        }
        .btn-auth:hover { transform: translate(-2px,-2px) rotate(-.4deg); box-shadow: 9px 10px 0 #7a1e06; }
        .btn-auth:hover::after { transform: translateX(100%); }
        .btn-auth:active { transform: translate(1px,1px); box-shadow: 2px 3px 0 #7a1e06; }

        /* ── Switch link ── */
        .auth-switch {
            margin-top: 24px; text-align: center;
            color: var(--muted); font-size: .9rem;
        }
        .auth-switch a {
            color: var(--primary); font-weight: 700;
            text-decoration: none;
            transition: opacity .2s;
        }
        .auth-switch a:hover { opacity: .75; text-decoration: underline; }

        /* ── Alert ── */
        .alert-auth {
            margin-bottom: 20px; padding: 13px 16px;
            border-radius: 12px 16px 11px 17px;
            border: 1px solid rgba(248,160,34,.3);
            background: rgba(248,160,34,.1); color: #ffe5b9;
            font-size: .88rem; line-height: 1.5;
        }
        .alert-auth.is-error {
            border-color: rgba(255,119,97,.3);
            background: rgba(255,119,97,.1); color: #ffd9d1;
        }

        /* Divider */
        .auth-divider {
            display: flex; align-items: center; gap: 12px;
            margin: 4px 0 20px; color: var(--muted); font-size: .8rem;
        }
        .auth-divider::before, .auth-divider::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }

        /* ── Mobile: stack layout ── */
        @media (max-width: 780px) {
            .auth-page    { flex-direction: column; }
            .auth-left    { width: 100%; padding: 28px 20px; border-right: 0; border-bottom: 1px solid var(--border); flex-direction: row; flex-wrap: wrap; justify-content: center; gap: 20px; }
            .auth-brand   { display: none; }
            .student-svg  { width: 120px; }
            .char-glow    { display: none; }
            .speech-bubble{ font-size: .88rem; }
            .auth-right   { padding: 28px 20px 40px; }
            .auth-heading { font-size: 1.55rem; }
        }
    </style>
</head>
<body>
    {{-- Background doodles (shared with app layout) --}}
    <div class="doodle doodle-sun" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
    <div class="doodle doodle-star" aria-hidden="true">✦</div>

    <div class="auth-page">

        {{-- ═══════════════════════════════════════════════ --}}
        {{-- LEFT PANEL: animated student character          --}}
        {{-- ═══════════════════════════════════════════════ --}}
        <div class="auth-left" aria-hidden="true">

            {{-- Floating particles --}}
            <span class="particle" style="--top:8%;  --left:12%; --size:9px;  --dur:10s; --delay:0s;   --tx:30px;  --ty:-50px; --tx2:-20px; --ty2:-80px"></span>
            <span class="particle" style="--top:15%; --left:78%; --size:5px;  --dur:7s;  --delay:1.3s; --tx:-25px; --ty:-45px; --tx2:15px;  --ty2:-65px"></span>
            <span class="particle" style="--top:72%; --left:18%; --size:11px; --dur:12s; --delay:2.1s; --tx:45px;  --ty:-60px; --tx2:-30px; --ty2:-85px"></span>
            <span class="particle" style="--top:80%; --left:72%; --size:6px;  --dur:8s;  --delay:0.7s; --tx:-30px; --ty:-55px; --tx2:20px;  --ty2:-75px"></span>
            <span class="particle" style="--top:45%; --left:88%; --size:8px;  --dur:9s;  --delay:3.2s; --tx:-40px; --ty:-40px; --tx2:25px;  --ty2:-60px"></span>
            <span class="particle" style="--top:30%; --left:5%;  --size:5px;  --dur:11s; --delay:1.8s; --tx:20px;  --ty:-35px; --tx2:-15px; --ty2:-55px"></span>
            <span class="particle" style="--top:60%; --left:50%; --size:7px;  --dur:8s;  --delay:4s;   --tx:-20px; --ty:-50px; --tx2:30px;  --ty2:-70px"></span>
            <span class="particle" style="--top:90%; --left:40%; --size:4px;  --dur:6s;  --delay:0.4s; --tx:15px;  --ty:-30px; --tx2:-10px; --ty2:-50px"></span>

            {{-- Glow behind character --}}
            <div class="char-glow"></div>

            {{-- Brand --}}
            <div class="auth-brand">
                <div class="auth-brand-mark">A</div>
                <h1>AcademiaPro</h1>
                <p>Academic Suite</p>
            </div>

            {{-- ── Animated Saluting Student ── --}}
            <svg class="student-svg" viewBox="0 0 200 330" xmlns="http://www.w3.org/2000/svg"
                 role="img" aria-label="Student saluting">

                {{-- Shadow on ground (no bob, stays still) --}}
                <ellipse cx="100" cy="322" rx="48" ry="9" fill="rgba(0,0,0,0.3)">
                    <animate attributeName="rx"
                             values="48;38;48" dur="2.8s" repeatCount="indefinite"
                             calcMode="spline" keyTimes="0;0.5;1"
                             keySplines="0.45 0 0.55 1;0.45 0 0.55 1"/>
                    <animate attributeName="opacity"
                             values="0.3;0.12;0.3" dur="2.8s" repeatCount="indefinite"
                             calcMode="spline" keyTimes="0;0.5;1"
                             keySplines="0.45 0 0.55 1;0.45 0 0.55 1"/>
                </ellipse>

                {{-- ── Full character group (bobs up & down) ── --}}
                <g>
                    {{-- Shoes --}}
                    <ellipse cx="76"  cy="307" rx="24" ry="10" fill="#0e0b09"/>
                    <ellipse cx="124" cy="307" rx="24" ry="10" fill="#0e0b09"/>

                    {{-- Pants / Legs --}}
                    <rect x="65"  y="218" width="25" height="92" rx="11" fill="#281e18"/>
                    <rect x="110" y="218" width="25" height="92" rx="11" fill="#281e18"/>

                    {{-- Left hand --}}
                    <circle cx="41" cy="213" r="13" fill="#ffcb8e"/>
                    {{-- Left arm --}}
                    <rect x="32" y="140" width="22" height="77" rx="11" fill="#ff5a1f"/>

                    {{-- Uniform body --}}
                    <path d="M54 140 Q100 131 146 140 L150 225 Q100 233 50 225 Z" fill="#ff5a1f"/>

                    {{-- Collar V-shape --}}
                    <path d="M79 140 L100 158 L121 140" stroke="#c04010" stroke-width="3.5" fill="none" stroke-linecap="round"/>

                    {{-- Tie --}}
                    <polygon points="100,140 91,163 100,186 109,163" fill="#c04010"/>
                    <circle cx="100" cy="187" r="5.5" fill="#c04010"/>

                    {{-- Breast pocket --}}
                    <rect x="58" y="158" width="24" height="19" rx="4" fill="rgba(192,64,16,0.45)" stroke="#c04010" stroke-width="1.2"/>

                    {{-- ── RIGHT ARM (saluting) – animated ── --}}
                    <g>
                        {{-- Arm as a curved stroke from shoulder (143,142) up to hand near forehead --}}
                        <path d="M 143 142 Q 127 107 109 75"
                              stroke="#ff5a1f" stroke-width="22"
                              stroke-linecap="round" fill="none"/>
                        {{-- Hand at forehead --}}
                        <circle cx="109" cy="72" r="14" fill="#ffcb8e"/>

                        {{-- Salute rock animation around the shoulder joint --}}
                        <animateTransform
                            attributeName="transform"
                            type="rotate"
                            values="0 143 142; -10 143 142; 4 143 142; -7 143 142; 0 143 142"
                            dur="3.5s"
                            repeatCount="indefinite"
                            calcMode="spline"
                            keyTimes="0; 0.25; 0.5; 0.75; 1"
                            keySplines="0.45 0 0.55 1; 0.45 0 0.55 1; 0.45 0 0.55 1; 0.45 0 0.55 1"/>
                    </g>

                    {{-- Neck --}}
                    <rect x="87" y="126" width="26" height="20" rx="8" fill="#ffcb8e"/>

                    {{-- ── HEAD ── --}}
                    <circle cx="100" cy="86" r="44" fill="#ffcb8e"/>

                    {{-- Graduation cap brim --}}
                    <ellipse cx="100" cy="50" rx="54" ry="12" fill="#1b120d"/>
                    {{-- Cap top body --}}
                    <rect x="68" y="24" width="64" height="30" rx="5" fill="#ff5a1f"/>
                    {{-- Cap button --}}
                    <circle cx="100" cy="24" r="7" fill="#c04010"/>
                    {{-- Tassel cord --}}
                    <path d="M 153 50 Q 161 60 163 77"
                          stroke="#ffa050" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                    {{-- Tassel pom --}}
                    <circle cx="163" cy="80" r="6" fill="#ffa050"/>
                    <line x1="160" y1="80" x2="156" y2="92" stroke="#ffa050" stroke-width="2" stroke-linecap="round"/>
                    <line x1="163" y1="80" x2="163" y2="93" stroke="#ffa050" stroke-width="2" stroke-linecap="round"/>
                    <line x1="166" y1="80" x2="170" y2="92" stroke="#ffa050" stroke-width="2" stroke-linecap="round"/>

                    {{-- ── Eyes ── --}}
                    <ellipse cx="84"  cy="86" rx="9" ry="10" fill="#1b120d"/>
                    <ellipse cx="82"  cy="84" rx="3" ry="3.5" fill="white"/>
                    <ellipse cx="116" cy="86" rx="9" ry="10" fill="#1b120d"/>
                    <ellipse cx="114" cy="84" rx="3" ry="3.5" fill="white"/>

                    {{-- Blink overlay (skin-colour rects that grow to cover eyes) --}}
                    <rect x="75" y="82" width="18" height="0" rx="3" fill="#ffcb8e">
                        <animate attributeName="height"
                                 values="0;0;0;0;0;0;12;0;0;0;0;0;0;0;12;0"
                                 dur="8s" repeatCount="indefinite"/>
                    </rect>
                    <rect x="107" y="82" width="18" height="0" rx="3" fill="#ffcb8e">
                        <animate attributeName="height"
                                 values="0;0;0;0;0;0;12;0;0;0;0;0;0;0;12;0"
                                 dur="8s" repeatCount="indefinite"/>
                    </rect>

                    {{-- Smile --}}
                    <path d="M82 106 Q100 125 118 106"
                          stroke="#8B4513" stroke-width="3.5" fill="none" stroke-linecap="round"/>

                    {{-- Blush cheeks --}}
                    <ellipse cx="68"  cy="97" rx="13" ry="8" fill="rgba(255,110,70,0.28)"/>
                    <ellipse cx="132" cy="97" rx="13" ry="8" fill="rgba(255,110,70,0.28)"/>

                    {{-- ── BODY BOB ANIMATION ── --}}
                    <animateTransform
                        attributeName="transform"
                        type="translate"
                        values="0,0; 0,-13; 0,0"
                        dur="2.8s"
                        repeatCount="indefinite"
                        calcMode="spline"
                        keyTimes="0;0.5;1"
                        keySplines="0.45 0 0.55 1;0.45 0 0.55 1"/>
                </g>
            </svg>

            {{-- Speech bubble --}}
            <div class="speech-bubble">
                @yield('speech-text', '👋 Hello there!')
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════ --}}
        {{-- RIGHT PANEL: form                               --}}
        {{-- ═══════════════════════════════════════════════ --}}
        <div class="auth-right">
            <div class="auth-form-wrap">
                @yield('form-content')
            </div>
        </div>

    </div>
</body>
</html>
