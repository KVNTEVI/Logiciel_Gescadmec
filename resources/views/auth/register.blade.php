<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte - GESCADMEC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg" style="width: 450px; border-radius: 15px;">
        
        <div class="card-header bg-success text-white text-center" style="border-radius: 15px 15px 0 0;">
            <h3>Créer un compte</h3>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('register.perform') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" name="name" id="name" class="form-control"
                           required placeholder="Nom de la secrétaire">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                           required placeholder="exemple@domaine.com">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control"
                           required placeholder="********">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmez le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control" required placeholder="********">
                </div>

                <button class="btn btn-success w-100">Créer le compte</button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Déjà un compte ? Se connecter</a>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
