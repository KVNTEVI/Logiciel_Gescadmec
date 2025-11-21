<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GESCADMEC - Dashboard</title> -->

    <!-- Bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }
        .sidebar {
            height: 100vh;
            background: #0d6efd;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
        }
    </style>
</head>

<body>

<div class="d-flex"> -->
    <!-- Sidebar -->
    <!-- <div class="sidebar">
        <h4 class="text-center mb-4">GESCADMEC</h4>

        <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="{{ route('etudiants.index') }}"><i class="bi bi-people"></i> Étudiants</a>
        <a href="{{ route('niveaux.index') }}"><i class="bi bi-layers"></i> Niveaux</a>
        <a href="{{ route('inscriptions.index') }}"><i class="bi bi-journal-text"></i> Inscriptions</a>
        <a href="{{ route('paiements.index') }}"><i class="bi bi-cash-coin"></i> Paiements</a>
        <a href="{{ route('besoins.index') }}"><i class="bi bi-list-task"></i> Besoins</a>
    </div>

    <!-- Content -->
    <!-- <div class="p-4 flex-grow-1">
        @yield('content')
    </div>

</div>

</body>
</html> --> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #0d6efd;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
        }
        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        .header-top {
            background: #ffffff;
            padding: 20px;
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

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-center py-3">Menu</h4>

        <a href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i> Tableau de bord
        </a>
        <a href="{{ route('etudiants.index') }}">
            <i class="bi bi-people"></i> Étudiants
        </a>
        <a href="{{ route('inscriptions.index') }}">
            <i class="bi bi-journal-text"></i> Inscriptions
        </a>
        <a href="{{ route('paiements.index') }}">
            <i class="bi bi-cash"></i> Paiements
        </a>
        <a href="{{ route('niveaux.index') }}">
            <i class="bi bi-layers"></i> Niveaux
        </a>
        <a href="{{ route('besoins.index') }}">
            <i class="bi bi-exclamation-circle"></i> Besoins
        </a>
    </div>

    <!-- CONTENU -->
    <div class="content">

        <!-- HEADER FIXE AVEC UTILISATEUR + LOGOUT -->
        <div class="header-top">

            <h4 class="m-0">PRIMAACADEMIE</h4>

            <div class="user-info">
                <!-- Nom de l'utilisateur -->
                <span class="fw-bold text-primary">
                    <i class="bi bi-person-circle"></i>
                    {{ Auth::user()->name }}
                </span>

                <!-- Bouton Déconnexion -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>

        <div class="p-4">
            @yield('content')
        </div>

    </div>

</body>
</html>
