<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Professional student management portal">
        <title>@yield('title', 'Student Management')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="doodle doodle-sun" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
        <div class="doodle doodle-squiggle" aria-hidden="true">~</div>
        <div class="doodle doodle-star" aria-hidden="true">✦</div>
        <div class="app-shell">
            <aside class="sidebar">
                <div class="brand-wrap">
                    <div class="brand-mark">A</div>
                    <div>
                        <p class="eyebrow">Academic Suite</p>
                        <h1>AcademiaPro</h1>
                    </div>
                </div>

                <nav class="sidebar-nav" aria-label="Main navigation">
                    <a class="nav-item active" href="{{ route('students.index') }}">
                        <span class="nav-icon">⌂</span>
                        Overview
                    </a>
                    <a class="nav-item" href="{{ route('students.index') }}">
                        <span class="nav-icon">◎</span>
                        Students
                    </a>
                    <a class="nav-item" href="{{ route('students.create') }}">
                        <span class="nav-icon">＋</span>
                        Add Student
                    </a>
                </nav>

                <div class="sidebar-footer">
                    <p class="eyebrow">Signed in as</p>
                    <div class="status-card" style="flex-direction: column; align-items: flex-start; gap: 12px;">
                        <div style="display:flex; align-items:center; gap:10px; width:100%;">
                            <span class="status-dot"></span>
                            <span style="font-size:.88rem; font-weight:600; color:var(--text); overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                {{ Auth::user()->name }}
                            </span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" style="width:100%;">
                            @csrf
                            <button id="logout-btn" type="submit" class="btn btn-secondary" style="width:100%; font-size:.82rem; min-height:36px; padding: 8px 12px;">
                                Sign out ↩
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <main class="main-panel">
                <header class="topbar">
                    <div>
                        <p class="eyebrow">Student Operations</p>
                        <h2>@yield('page-title', 'Dashboard')</h2>
                    </div>

                    <div class="topbar-actions">
                        @yield('page-actions')
                    </div>
                </header>

                @if (session('success'))
                    <div class="alert success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </body>
</html>
