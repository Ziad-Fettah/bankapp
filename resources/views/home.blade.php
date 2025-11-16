<!DOCTYPE html>
<html>
<head>
    <title>Bank System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0b3c5d, #1d2731);
            color: white;
            text-align: center;
            padding-top: 80px;
        }

        h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 40px;
            opacity: 0.8;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 50px;
        }

        .card {
            background: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 15px;
            width: 250px;
            text-align: center;
            transition: 0.3s ease;
            backdrop-filter: blur(10px);
            cursor: pointer;
        }

        .card:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-5px);
        }

        .card a {
            color: white;
            text-decoration: none;
            font-size: 22px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>🏦 Bank Management System</h1>
    <p>Gérer vos clients, comptes bancaires et virements facilement.</p>

    <div class="container">
        <div class="card">
            <a href="{{ route('clients.index') }}">👤 Clients</a>
        </div>

        <div class="card">
            <a href="{{ route('accounts.index') }}">💳 Comptes</a>
        </div>

        <div class="card">
            <a href="{{ route('transfers.index') }}">💸 Virements</a>
        </div>

        <div class="card">
    <a href="{{ route('stats.index') }}">📊 Statistiques</a>
</div>

    </div>

</body>
</html>
