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
    <a href="{{ route('clients.index') }}">Clients</a> |
    <a href="{{ route('accounts.index') }}">Comptes</a> |
    <a href="{{ route('transfers.index') }}">Virement</a>
</nav>

<div class="container">
    @if(session('success'))
    <div class="alert">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
