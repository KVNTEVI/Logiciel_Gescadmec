<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte - GESCADMEC</title>
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
            /* Fond vert foncé, adapté à la couleur de succès */
            background-color: #198754; 
            color: white;
            padding: 15px 0; /* PADDING RÉDUIT */
            border-radius: 12px 12px 0 0;
        }
        .app-title {
            /* TAILLE RÉDUITE : H3 au lieu de H1 */
            font-size: 1.75rem; 
        }
        .role-title {
             /* TAILLE RÉDUITE : H6 au lieu de H5 */
            font-size: 1rem;
            margin-top: 10px !important;
        }
        .welcome-text {
            /* TAILLE RÉDUITE */
            font-size: 0.8rem;
            opacity: 0.8;
            margin-top: 3px;
        }
        .form-control {
            border-radius: 6px; /* Légèrement réduit */
        }
        .btn-success {
            /* Style pour le bouton principal de création */
            border-radius: 6px; /* Légèrement réduit */
            font-weight: bold;
        }
        .login-link {
            color: #007bff; 
            text-decoration: none;
            font-size: 0.9rem; /* Texte plus petit */
        }
        .login-link:hover {
            text-decoration: underline;
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
            {{-- Titre du formulaire en H6 --}}
            <h6 class="mt-2 mb-0 role-title">Créer un nouveau compte</h6> 
        </div>

        {{-- PADDING RÉDUIT : p-3 au lieu de p-4 --}}
        <div class="card-body p-3"> 

            @if($errors->any())
                <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
                {{-- Padding vertical réduit sur l'alerte --}}
            @endif

            <form action="{{ route('register.perform') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nom complet</label>
                    {{-- TAILLE RÉDUITE : Suppression de form-control-lg --}}
                    <input type="text" name="name" id="name" class="form-control"
                        required placeholder="Nom de la secrétaire">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Adresse Email</label>
                    {{-- TAILLE RÉDUITE : Suppression de form-control-lg --}}
                    <input type="email" name="email" id="email" class="form-control"
                        required placeholder="exemple@domaine.com">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Mot de passe</label>
                    {{-- TAILLE RÉDUITE : Suppression de form-control-lg --}}
                    <input type="password" name="password" id="password" class="form-control"
                        required placeholder="********">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">Confirmez le mot de passe</label>
                    {{-- TAILLE RÉDUITE : Suppression de form-control-lg --}}
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control" required placeholder="********">
                </div>

                <div class="d-grid mt-3">
                    {{-- TAILLE RÉDUITE : btn-md au lieu de btn-lg, et marge supérieure réduite --}}
                    <button type="submit" class="btn btn-success btn-md">
                        Créer le compte
                    </button>
                </div>

                <div class="text-center mt-3">
                    {{-- Marge supérieure réduite --}}
                    <a href="{{ route('login') }}" class="login-link">Déjà un compte ? Se connecter</a>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>