<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion • BankPortal Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg: #0f172a;
            --card: rgba(15, 23, 42, 0.85);
            --accent: #d4af37;
            --gold-glow: rgba(212, 175, 55, 0.3);
            --text: #e2e8f0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0b1320 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            color: var(--text);
        }

        /* Animation d'icônes flottantes en arrière-plan */
        .floating-icons {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-icons i {
            position: absolute;
            font-size: 2.5rem;
            opacity: 0.08;
            color: var(--accent);
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0%   { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10%  { opacity: 0.1; }
            90%  { opacity: 0.08; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        /* Positionnement aléatoire des icônes */
        .floating-icons i:nth-child(1)  { left: 10%; animation-delay: 0s; }
        .floating-icons i:nth-child(2)  { left: 20%; animation-delay: 3s; }
        .floating-icons i:nth-child(3)  { left: 35%; animation-delay: 7s; }
        .floating-icons i:nth-child(4)  { left: 50%; animation-delay: 2s; }
        .floating-icons i:nth-child(5)  { left: 65%; animation-delay: 10s; }
        .floating-icons i:nth-child(6)  { left: 80%; animation-delay: 5s; }
        .floating-icons i:nth-child(7)  { left: 90%; animation-delay: 12s; }
        .floating-icons i:nth-child(8)  { left: 15%; animation-delay: 15s; }
        .floating-icons i:nth-child(9)  { left: 75%; animation-delay: 8s; }

        /* Carte de connexion */
        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            padding: 48px 40px;
            background: var(--card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            border: 1px solid rgba(212, 175, 55, 0.25);
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.5),
                0 0 80px var(--gold-glow);
            text-align: center;
        }

        .logo {
            width: 100px; height: 100px;
            background: linear-gradient(135deg, var(--accent), #f0c757);
            border-radius: 50%;
            margin: 0 auto 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 44px;
            color: #0f172a;
            font-weight: bold;
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.5);
        }

        h1 {
            font-size: 30px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 16px;
            margin-bottom: 36px;
        }

        .form-group {
            margin-bottom: 26px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #cbd5e1;
            font-size: 15px;
        }

        input {
            width: 100%;
            padding: 18px 22px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            color: white;
            font-size: 17px;
            transition: all 0.4s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.25);
        }

        button {
            width: 100%;
            padding: 18px;
            margin-top: 10px;
            background: linear-gradient(135deg, var(--accent), #f0c757);
            color: #0f172a;
            border: none;
            border-radius: 16px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
        }

        button:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.6);
        }

        .error-alert {
            background: rgba(239, 68, 68, 0.15);
            border-left: 4px solid #ef4444;
            padding: 16px 20px;
            border-radius: 12px;
            color: #fca5a5;
            margin-bottom: 24px;
            text-align: left;
            backdrop-filter: blur(10px);
        }

        .footer {
            margin-top: 40px;
            font-size: 13px;
            color: #64748b;
        }
    </style>
</head>
<body>

    <!-- Icônes flottantes en arrière-plan -->
    <div class="floating-icons">
        <i class="fas fa-euro-sign"></i>
        <i class="fas fa-dollar-sign"></i>
        <i class="fas fa-credit-card"></i>
        <i class="fas fa-university"></i>
        <i class="fas fa-exchange-alt"></i>
        <i class="fas fa-lock"></i>
        <i class="fas fa-shield-alt"></i>
        <i class="fas fa-chart-line"></i>
        <i class="fas fa-wallet"></i>
    </div>

    <div class="login-card">
        <div class="logo">AB</div>
        <h1>Amane Bank</h1>
        <p class="subtitle">Connexion sécurisée • Administration</p>

        @if($errors->any())
            <div class="error-alert">
                <strong>Identifiants incorrects</strong>
                <ul style="margin-top: 8px; padding-left: 20px; font-size: 14px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="form-group">
                <label>Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@bankportal.pro">
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required placeholder="••••••••••••">
            </div>

            <button type="submit">
                Se connecter
            </button>
        </form>

        <div class="footer">
            © {{ date('Y') }} Amane Bank • Tous droits réservés
        </div>
    </div>

</body>
</html>