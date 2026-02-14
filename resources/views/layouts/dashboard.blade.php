<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tableau de bord') | Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #0d6efd;
            color: white;
            transition: all 0.3s;
        }
        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            padding: 15px 20px;
            display: block;
            text-decoration: none;
            border-left: 4px solid transparent;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        /* Classe pour le lien actif */
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: bold;
            border-left: 4px solid #fff;
        }
        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }
        .header-top {
            background: #ffffff;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="text-center py-4">Scolarité Pro</h4>
        <hr class="mx-3">

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
        </a>

        <a href="{{ route('etudiants.index') }}" class="{{ request()->routeIs('etudiants.*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Étudiants
        </a>

        <a href="{{ route('inscriptions.index') }}" class="{{ request()->routeIs('inscriptions.*') ? 'active' : '' }}">
            <i class="bi bi-journal-text me-2"></i> Inscriptions
        </a>

        <a href="{{ route('paiements.index') }}" class="{{ request()->routeIs('paiements.*') ? 'active' : '' }}">
            <i class="bi bi-cash me-2"></i> Paiements
        </a>

        <a href="{{ route('niveaux.index') }}" class="{{ request()->routeIs('niveaux.*') ? 'active' : '' }}">
            <i class="bi bi-layers me-2"></i> Niveaux
        </a>

        <a href="{{ route('besoins.index') }}" class="{{ request()->routeIs('besoins.*') ? 'active' : '' }}">
            <i class="bi bi-exclamation-circle me-2"></i> Besoins
        </a>
    </div>

    <div class="content">

        <div class="header-top">
            <h4 class="m-0 text-dark">@yield('title', 'Tableau de bord')</h4>

            <div class="user-info">
                <span class="fw-bold text-primary">
                    <i class="bi bi-person-circle"></i>
                    {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>

        <div class="p-4">
            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>