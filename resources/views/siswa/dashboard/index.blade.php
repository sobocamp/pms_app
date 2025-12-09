<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Mobile App' }} - AdminKit</title>
    <link href="/assets/css/app.css" rel="stylesheet"> <!-- AdminKit -->
    <script src="/assets/js/app.js"></script>
    <style>
        body {
            background-color: #f5f7fb;
            padding-bottom: 70px; /* space for bottom nav */
        }
        .mobile-container {
            max-width: 480px;
            margin: auto;
            background: #fff;
            min-height: 100vh;
        }
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            background: #fff;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            z-index: 999;
        }
        .bottom-nav a {
            text-align: center;
            flex: 1;
            color: #6c757d;
        }
        .bottom-nav a.active {
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="mobile-container">
    <header class="navbar navbar-light bg-white px-3 py-2 border-bottom">
        <h5 class="m-0 fw-bold">{{ $title ?? 'Mobile Page' }}</h5>
    </header>

    <main class="p-3">
        @yield('content')
    </main>
</div>

<div class="bottom-nav">
    <a href="/home" class="{{ request()->is('home') ? 'active' : '' }}">
        <i data-feather="home"></i><br>Home
    </a>
    <a href="/activity" class="{{ request()->is('activity') ? 'active' : '' }}">
        <i data-feather="grid"></i><br>Activity
    </a>
    <a href="/profile" class="{{ request()->is('profile') ? 'active' : '' }}">
        <i data-feather="user"></i><br>Profile
    </a>
</div>

<script>
    feather.replace();
</script>
</body>
</html>
