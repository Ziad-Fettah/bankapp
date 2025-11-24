@extends('layouts.app')

@section('content')
<style>
    /* ====== BODY ====== */
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #0b3c5d, #1a507a);
        color: #1f2a38;
        min-height: 100vh;
    }



    /* ====== MAIN CONTENT ====== */
    .main-content {
        margin-left: 180px;
        padding: 40px 30px;
        transition: margin-left 0.3s ease;
    }

    .main-content h1 {
        font-size: 36px;
        color: #ffffff;
        margin-bottom: 10px;
        text-shadow: 0 0 6px #00c0ff;
    }

    .main-content p {
        font-size: 16px;
        color: #cde4f7;
        margin-bottom: 30px;
    }

    /* ====== DASHBOARD CARDS ====== */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 25px;
    }

    .dashboard-card {
        background: linear-gradient(145deg, #0e4b78, #0a3756);
        border-radius: 15px;
        padding: 20px 20px;
        text-align: center;
        color: #ffffff;
        box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        transition: all 0.3s ease;
        font-weight: 600;
        cursor: pointer;
           
    }

    .dashboard-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 15px 40px rgba(0,192,255,0.6);
        background: linear-gradient(145deg, #0099ff, #00c0ff);
    }

    .dashboard-card i {
        font-size: 40px;
        margin-bottom: 15px;
        color: #00c0ff;
        transition: all 0.3s ease;
    }

    .dashboard-card:hover i {
        color: #ffffff;
    }

    .dashboard-card h5 {
        margin-bottom: 10px;
        font-size: 18px;
    }

    .dashboard-card p {
        font-size: 14px;
        opacity: 0.85;
        margin-bottom: 15px;
    }

    .dashboard-card a {
        display: inline-block;
        padding: 10px 10px;
        border-radius: 8px;
        text-decoration: none;
        background: #00c0ff;
        color: #0b3c5d;
        font-weight: 600;
        font-size: 14px;
        transition: 0.3s;
    }

    .dashboard-card a:hover {
        background: #0099ff;
        color: #ffffff;
    }

    /* ====== OVERVIEW ====== */
    .overview {
        text-align: center;
        padding: 30px 0 60px;
        color: #cde4f7;
    }

    .overview h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .overview p {
        font-size: 16px;
        opacity: 0.85;
    }

    /* ====== RESPONSIVE ====== */
    @media (max-width: 768px) {
        .sidebar {
            width: 60px;
        }

        .sidebar a span {
            display: none;
        }

        .main-content {
            margin-left: 60px;
            padding: 20px 15px;
        }

        .main-content h1 { font-size: 28px; }
        .dashboard-card { padding: 20px 15px; }
        .dashboard-card i { font-size: 32px; }
        .dashboard-card h5 { font-size: 16px; }
        .dashboard-card p { font-size: 12px; }
        .dashboard-card a { font-size: 12px; padding: 8px 16px; }
        .overview h2 { font-size: 20px; }
        .overview p { font-size:14px; }
    }
</style>

<div class="main-content">
    <h1>Bienvenue sur le Tableau de Bord</h1>
    <p>Gérez vos clients, comptes et transactions de manière professionnelle et sécurisée.</p>

    <div class="dashboard-cards">
        <div class="dashboard-card">
            <i class="fas fa-users"></i>
            <h5>Clients</h5>
            <p>Liste complète et gestion des profils clients.</p>
            <a href="{{ route('clients.index') }}">Accéder</a>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-credit-card"></i>
            <h5>Comptes</h5>
            <p>Visualisation et administration des comptes bancaires.</p>
            <a href="{{ route('accounts.index') }}">Accéder</a>
        </div>
<br>
        <div class="dashboard-card">
            <i class="fas fa-exchange-alt"></i>
            <h5>Virements</h5>
            <p>Historique et création de transactions bancaires.</p>
            <a href="{{ route('transfers.index') }}">Accéder</a>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-chart-line"></i>
            <h5>Statistiques</h5>
            <p>Indicateurs clés de performance du système bancaire.</p>
            <a href="{{ route('stats.index') }}">Voir</a>
        </div>
    </div>

    <div class="overview">
        <h2>Aperçu Rapide</h2>
        <p>Accédez rapidement aux modules essentiels pour gérer les opérations bancaires avec fiabilité et sécurité.</p>
    </div>
</div>
@endsection