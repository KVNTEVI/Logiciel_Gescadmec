@extends('layouts.app')

@section('content')

<div class="row mb-4">

    <!-- Étudiants -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="text-primary">
                    <i class="bi bi-people-fill"></i>
                </h1>
                <h3>{{ $totalEtudiants }}</h3>
                <p class="text-muted">Étudiants inscrits</p>
            </div>
        </div>
    </div>

    <!-- Paiements -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="text-success">
                    <i class="bi bi-cash-coin"></i>
                </h1>
                <h3>{{ $totalPaiements }}</h3>
                <p class="text-muted">Paiements enregistrés</p>
            </div>
        </div>
    </div>

    <!-- Besoins -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="text-warning">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </h1>
                <h3>{{ $totalBesoins }}</h3>
                <p class="text-muted">Besoins soumis</p>
            </div>
        </div>
    </div>

</div>


<div class="row">

    <!-- Derniers Paiements -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0">
                    <i class="bi bi-cash-coin"></i> Derniers paiements d’inscription
                </h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Étudiant</th>
                            <th>Montant</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($paiements as $p)
                        <tr>
                            <td>{{ $p->id_paiement }}</td>

                            <td>
                                {{ $p->inscription->etudiant->nom ?? '' }}
                                {{ $p->inscription->etudiant->prenom ?? '' }}
                            </td>

                            <td>{{ number_format($p->montant, 2) }} FCFA</td>

                            <td>{{ $p->date_paiement }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Derniers Besoins -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-warning">
                <h5 class="m-0 text-dark">
                    <i class="bi bi-chat-left-text"></i> Derniers besoins
                </h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Étudiant</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($besoins as $b)
                        <tr>
                            <td>{{ $b->id_besoin }}</td>

                            <td>
                                {{ $b->etudiant->nom ?? '' }}
                                {{ $b->etudiant->prenom ?? '' }}
                            </td>

                            <td>{{ Str::limit($b->description, 40) }}</td>

                            <td>{{ $b->date_soumission }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection
