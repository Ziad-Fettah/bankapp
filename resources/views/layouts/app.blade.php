<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Amane Bank')</title>

    <!-- Google Fonts: Inter (fintech pro) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary: #0a2d5e;
            --secondary: #004c99;
            --accent: #d4af37;
            --light: #f8f9fc;
            --dark: #1e293b;
            --gray: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --card-bg: rgba(255, 255, 255, 0.08);
            --card-border: rgba(255, 255, 255, 0.12);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
            min-height: 100vh;
            padding-left: 260px;
            transition: padding-left 0.35s ease;
        }

        /* ====================== SIDEBAR ====================== */
        .sidebar {
            position: fixed;
            left: 0; top: 0; bottom: 0;
            width: 260px;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255,255,255,0.08);
            padding: 0;
            transition: all 0.35s ease;
            z-index: 1000;
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: 78px;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .sidebar.collapsed .sidebar-header span { display: none; }

        .logo-icon {
            width: 42px; height: 42px;
            background: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #0f172a;
            font-weight: 800;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
            color: white;
        }

        .nav-menu { padding: 20px 0; }

        .nav-item { position: relative; }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-link i {
            font-size: 20px;
            width: 36px;
            text-align: center;
        }

        .nav-link span {
            margin-left: 14px;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .sidebar.collapsed .nav-link span { opacity: 0; pointer-events: none; }

        .nav-link:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        .nav-link.active {
            background: linear-gradient(90deg, var(--accent), #f0c757);
            color: #0f172a;
            font-weight: 600;
        }

        .nav-link.active i { color: #0f172a; }

        /* Tooltip quand sidebar repliée */
        .sidebar.collapsed .nav-link::after {
            content: attr(data-title);
            position: absolute;
            left: 78px;
            top: 50%;
            transform: translateY(-50%);
            background: #1e293b;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 13px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
            z-index: 10;
        }

        .sidebar.collapsed .nav-link:hover::after { opacity: 1; }

        /* ====================== TOPBAR ====================== */
        .topbar {
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            height: 70px;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 999;
            transition: left 0.35s ease;
        }

        .sidebar.collapsed ~ .topbar { left: 78px; }

        .toggle-btn {
            font-size: 22px;
            cursor: pointer;
            color: #cbd5e1;
            transition: 0.3s;
        }

        .toggle-btn:hover { color: white; }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

    /* CORRECTION COULEUR DES <option> DANS LES <select> SOMBRES */
    select {
        color: white !important;
        background: rgba(255,255,255,0.08) !important;
    }

    select option {
        color: #1e293b !important;        /* texte noir sur fond clair quand le menu déroulant s’ouvre */
        background: #f1f5f9 !important;   /* fond clair pour une lecture parfaite */
    }

    /* Option sélectionnée dans le menu déroulant (quand ouvert) */
    select option:checked {
        background: var(--accent) !important;
        color: #0f172a !important;
    }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #0f172a;
        }

        /* ====================== MAIN CONTENT ====================== */
        .main-content {
            padding: 100px 40px 40px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: #94a3b8;
            font-size: 16px;
            margin-bottom: 40px;
        }

        /* Cards réutilisables */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 28px;
            backdrop-filter: blur(10px);
            transition: all 0.4s ease;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            border-color: var(--accent);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 48px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            body { padding-left: 78px; }
            .sidebar { width: 78px; }
            .sidebar .logo-text, .sidebar span { display: none; }
            .topbar { left: 78px; }
        }

        @media (max-width: 576px) {
            .main-content { padding: 90px 20px 20px; }
            .page-title { font-size: 26px; }
        }

        .logout-btn {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    color: #cbd5e1;
    padding: 10px 14px;
    margin-right: 15px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 18px;
    transition: 0.3s ease;
}

.logout-btn:hover {
    background: rgba(255,255,255,0.15);
    color: white;
    border-color: var(--accent);
    transform: translateY(-2px);
}

    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">AB</div>
            <span class="logo-text">Amane Bank</span>
        </div>
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}" data-title="Tableau de bord">
    <i class="fas fa-tachometer-alt"></i><span>Tableau de bord</span>
</a>

            </div>
            <div class="nav-item">
                <a href="{{ route('clients.index') }}" class="nav-link {{ request()->is('clients*') ? 'active' : '' }}" data-title="Clients">
                    <i class="fas fa-users"></i><span>Clients</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('accounts.index') }}" class="nav-link {{ request()->is('accounts*') ? 'active' : '' }}" data-title="Comptes">
                    <i class="fas fa-credit-card"></i><span>Comptes</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('transfers.index') }}" class="nav-link {{ request()->is('transfers*') ? 'active' : '' }}" data-title="Virements">
                    <i class="fas fa-exchange-alt"></i><span>Virements</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('stats.index') }}" class="nav-link {{ request()->is('stats*') ? 'active' : '' }}" data-title="Statistiques">
                    <i class="fas fa-chart-line"></i><span>Statistiques</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Topbar -->
    <header class="topbar">
        <i class="fas fa-bars toggle-btn" id="toggleBtn"></i>

        <!-- LOGOUT BUTTON -->
    <form action="{{ route('admin.logout') }}" method="POST" style="margin-left:20px;">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fas fa-right-from-bracket"></i>
        </button>
    </form>

        <div class="user-info">
            <span style="color:#94a3b8;">Bonjour, <strong>{{ Auth::user()->name ?? 'Administrateur' }}</strong></span>
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script>
        document.getElementById('toggleBtn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>

    @stack('scripts')
</body>
</html>