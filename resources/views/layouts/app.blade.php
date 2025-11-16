<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','BankApp')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav>
    <div style="background:#0b3c5d; padding:15px; display:flex; gap:20px;">
    <a href="{{ url('/') }}" style="color:white;">🏠 Accueil</a>

    <a href="{{ route('clients.index') }}" style="color:white;">👤 Clients</a>
    <a href="{{ route('accounts.index') }}" style="color:white;">💳 Comptes</a>
    <a href="{{ route('transfers.index') }}" style="color:white;">💸 Virements</a>

    <a href="{{ route('stats.index') }}" style="color:white; font-weight:bold;">📊 Statistiques</a>
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
