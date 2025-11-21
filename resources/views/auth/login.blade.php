<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - GESCADMEC</title>
    {{-- Utilisation de Bootstrap 5.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles personnalisés pour le fond et l'alignement */
        body {
            /* Arrière-plan dégradé bleu-gris doux */
            background: linear-gradient(135deg, #f0f2f5 0%, #c1d5e0 100%); 
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            /* TAILLE RÉDUITE : 380px au lieu de 450px */
            width: 380px; 
            border: none;
            border-radius: 12px; /* Légèrement réduit */
            overflow: hidden;
        }
        .card-header-custom {
            /* Fond bleu foncé pour le header */
            background-color: #007bff; 
            color: white;
            padding: 15px 0; /* PADDING RÉDUIT */
            border-radius: 12px 12px 0 0;
        }
        .app-title {
            /* TAILLE RÉDUITE : H3 au lieu de H1 */
            font-size: 1.75rem; 
        }
        .welcome-text {
            /* TAILLE RÉDUITE */
            font-size: 0.8rem;
            opacity: 0.8;
            margin-top: 3px;
        }
        .role-title {
             /* TAILLE RÉDUITE : H6 au lieu de H5 */
            font-size: 1rem;
            margin-top: 10px !important;
        }
        .form-control {
            border-radius: 6px; /* Légèrement réduit */
        }
        .btn-primary {
            /* Couleur primaire plus vive */
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 6px; /* Légèrement réduit */
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center">
    <div class="card shadow-lg">
        
        <div class="card-header-custom text-center">
            {{-- Nom du logiciel en H3 pour réduire la taille --}}
            <h3 class="mb-0 fw-bold app-title">GESCADMEC</h3> 
            {{-- Texte de Bienvenue personnalisé --}}
            <p class="welcome-text">Système de Gestion Administrative & Scolaire</p>
            <h6 class="mt-2 mb-0 role-title">Connexion Secrétaire</h6> 
        </div>

        {{-- PADDING RÉDUIT : p-3 au lieu de p-4 --}}
        <div class="card-body p-3"> 

            @if(session('success'))
                <div class="alert alert-success py-2">{{ session('success') }}</div> 
            @endif

            @if($errors->any())
                <div class="alert alert-danger py-2">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.perform') }}" method="POST">
                @csrf

                <div class="mb-3"> 
                    <label for="email" class="form-label fw-semibold">Adresse Email</label>
                    {{-- TAILLE RÉDUITE : Suppression de form-control-lg --}}
                    <input type="email" name="email" id="email" class="form-control"
                            placeholder="Entrer votre email" required>
                </div>

                <div class="mb-3"> 
                    <label for="password" class="form-label fw-semibold">Mot de Passe</label>
                    {{-- TAILLE RÉDUITE : Suppression de form-control-lg --}}
                    <input type="password" name="password" id="password" class="form-control"
                            placeholder="Entrer votre mot de passe" required>
                </div>

                <div class="d-grid mt-4">
                    {{-- TAILLE RÉDUITE : btn-md au lieu de btn-lg --}}
                    <button type="submit" class="btn btn-primary btn-md"> 
                        <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                    </button>
                </div>

            </form>

            <div class="text-center mt-3">
                {{-- Marge supérieure légèrement réduite --}}
                <a href="{{ route('register') }}" class="text-decoration-none text-primary small">Créer un compte</a>
            </div>

        </div>
    </div>
</div>

{{-- Assurez-vous d'avoir le code Font Awesome valide si vous utilisez les icônes --}}
<script src="https://kit.fontawesome.com/votre_code_font_awesome.js" crossorigin="anonymous"></script>

</body>
</html>