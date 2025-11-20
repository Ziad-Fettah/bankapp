<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','BankApp')</title>

    {{-- Your external CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* Background image */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;

            /* Background style */
            background: url("https://images.unsplash.com/photo-1567427013953-1d9b2bf09c3f")
                        no-repeat center center fixed;
            background-size: cover;
        }

        /* Transparent container card */
        .container {
            background: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 12px;
            width: 85%;
            max-width: 1100px;
            margin: 40px auto;
            box-shadow: 0 0 14px rgba(0,0,0,0.2);
        }

        /* Navbar */
        nav div {
            background: rgba(10, 50, 80, 0.9);
            padding: 15px;
            display: flex;
            gap: 25px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 17px;
            font-weight: bold;
            transition: 0.2s;
        }

        nav a:hover {
            color: #ffd700;
            text-decoration: underline;
        }

        /* Success alert */
        .alert {
            background: #d4edda;
            padding: 12px;
            border-left: 4px solid #218838;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<nav>
    <div>
        <a href="{{ url('/') }}">🏠 Accueil</a>
        <a href="{{ route('clients.index') }}">👤 Clients</a>
        <a href="{{ route('accounts.index') }}">💳 Comptes</a>
        <a href="{{ route('transfers.index') }}">💸 Virements</a>
        <a href="{{ route('stats.index') }}" style="font-weight:bold;">📊 Statistiques</a>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
