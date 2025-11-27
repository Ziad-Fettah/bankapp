<!doctype html>
<html>
<head>
    <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','BankApp')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        nav {
            background: linear-gradient(135deg, #0b3c5d, #1c5d99);
            padding: 15px 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        nav a:hover {
            text-decoration: underline;
            transform: scale(1.05);
        }

        nav a.active {
            font-weight: bold;
            border-bottom: 2px solid #ffd700;
        }

        /* Container */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            animation: fadeIn 0.7s ease-in-out;
        }
        /* Cards */
        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        /* Titles */
        h2 {
            text-align: center;
            color: #2d3e50;
            font-weight: 700;
            margin-bottom: 30px;
        }

        /* Forms */
        label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #3a4856;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d9e6;
            border-radius: 10px;
            font-size: 15px;
            margin-bottom: 22px;
            transition: 0.2s;
            background: #f9fbff;
        }

        input:focus, select:focus {
            border-color: #6a9df8;
            box-shadow: 0 0 8px rgba(106,157,248,0.4);
            background: #ffffff;
            outline: none;
        }

        /* Buttons */
        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #4c8ef7, #6a9df8);
            color: white;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(135deg, #3b7be0, #598cf2);
            transform: translateY(-2px);
        }

        /* Alerts */
        .alert {
            background: #d1f7dc;
            padding: 15px;
            border-radius: 10px;
            color: #0b3c5d;
            margin-bottom: 20px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 600px) {
            nav {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    
    <!-- Logout Button (top-right) -->
    @if(session()->has('admin_id'))
    <form action="{{ route('admin.logout') }}" method="POST" style="
        position: fixed;
        top: 15px;
        right: 20px;
        z-index: 1200;
    ">
        @csrf
        <button type="submit" style="
            background:#b00020;
            color:white;
            border:none;
            padding:8px 15px;
            border-radius:6px;
            cursor:pointer;
        ">
            Deconnecter
        </button>
    </form>
    @endif

    <div class="container">
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>


<!-- Hamburger button (hors de la sidebar mais visuellement à gauche) -->
<div id="toggleBtn" style="
    position: fixed;
    top: 15px;
    left: 15px;
    font-size: 24px;
    color: #fff;
    cursor: pointer;
    z-index: 1100;
">
    <i class="fas fa-bars"></i>
</div>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">BankPortal</div>
    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i><span>Accueil</span>
    </a>
    <a href="{{ route('clients.index') }}" class="{{ request()->is('clients*') ? 'active' : '' }}">
        <i class="fas fa-users"></i><span>Clients</span>
    </a>
    <a href="{{ route('accounts.index') }}" class="{{ request()->is('accounts*') ? 'active' : '' }}">
        <i class="fas fa-credit-card"></i><span>Comptes</span>
    </a>
    <a href="{{ route('transfers.index') }}" class="{{ request()->is('transfers*') ? 'active' : '' }}">
        <i class="fas fa-exchange-alt"></i><span>Virements</span>
    </a>
    <a href="{{ route('stats.index') }}" class="{{ request()->is('stats*') ? 'active' : '' }}">
        <i class="fas fa-chart-line"></i><span>Statistiques</span>
    </a>
</div>

<script>
const toggleBtn = document.getElementById('toggleBtn');
const sidebar = document.querySelector('.sidebar');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed'); // réduit ou agrandit la sidebar
});
</script>

<style>
/* Sidebar normale */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 220px;
    height: 100vh;
    background: linear-gradient(135deg, #0b3c5d, #093455);
    color: #fff;
    display: flex;
    flex-direction: column;
    padding: 20px 0;
    box-shadow: 2px 0 12px rgba(0,0,0,0.2);
    transition: width 0.3s ease;
    z-index: 1000;
}

/* Sidebar réduite */
.sidebar.collapsed {
    width: 0;
    overflow: hidden;
}

.sidebar a span {
    transition: opacity 0.3s;
}

.sidebar.collapsed a span {
    opacity: 0;
}
</style>


<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 220px;
    height: 100vh;
    background: linear-gradient(135deg, #0b3c5d, #093455);
    color: #fff;
    display: flex;
    flex-direction: column;
    padding: 20px 0;
    box-shadow: 2px 0 12px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    z-index: 1000;
}

.sidebar .logo {
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 40px;
    letter-spacing: 1px;
    color: #fff;
}

.sidebar a {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    margin: 4px 10px;
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.sidebar a i {
    width: 25px;
    margin-right: 12px;
    font-size: 18px;
    text-align: center;
}

.sidebar a span {
    font-size: 16px;
}

.sidebar a:hover {
    background: linear-gradient(90deg, #0099ff, #00c0ff);
    transform: translateX(4px);
    color: #fff;
}

.sidebar a.active {
    background: #00c0ff;
    color: #fff;
    box-shadow: 0 0 15px rgba(0,192,255,0.6);
}

.sidebar a.active i {
    color: #fff;
}

/* Optional: animation for clicking */
.sidebar a:active {
    transform: scale(0.98);
}
</style>
<script>
const toggleBtn = document.getElementById('toggleBtn');
const sidebar = document.querySelector('.sidebar');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
});
</script>



</body>
</html>