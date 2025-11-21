<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - GESCADMEC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg" style="width: 420px; border-radius: 15px;">
        
        <div class="card-header bg-primary text-white text-center" style="border-radius: 15px 15px 0 0;">
            <h3>Connexion Secrétaire</h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.perform') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                           placeholder="exemple@mail.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de Passe</label>
                    <input type="password" name="password" id="password" class="form-control"
                           placeholder="********" required>
                </div>

                <button class="btn btn-primary w-100">Se connecter</button>

            </form>

            <div class="text-center mt-3">
            <a href="{{ route('register') }}">Créer un compte</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
