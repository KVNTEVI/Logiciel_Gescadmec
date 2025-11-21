@extends('layouts.app')

@section('content')

<h2 class="mb-4">Dashboard</h2>

<div class="row">

    <!-- Derniers paiements -->
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="m-0"><i class="bi bi-cash-coin"></i> 3 Derniers Paiements</h5>
            </div>
            <div class="card-body">
                @forelse($lastPaiements as $p)
                    <div class="border-bottom pb-2 mb-2">
                        <strong>{{ number_format($p->montant, 0) }} FCFA</strong><br>
                        <small>Inscription : {{ $p->inscription->id_inscription }}</small><br>
                        <small>Étudiant : {{ $p->inscription->etudiant->nom ?? '---' }}</small><br>
                        <small class="text-muted">{{ $p->date_paiement }}</small>
                    </div>
                @empty
                    <p>Aucun paiement.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Dernières inscriptions -->
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0"><i class="bi bi-journal-check"></i> 3 Dernières Inscriptions</h5>
            </div>
            <div class="card-body">
                @forelse($lastInscriptions as $i)
                    <div class="border-bottom pb-2 mb-2">
                        <strong>{{ $i->etudiant->nom }} {{ $i->etudiant->prenom }}</strong><br>
                        <small>Niveau : {{ $i->niveau->nom_niveaux }}</small><br>
                        <small class="text-muted">{{ $i->date_inscription }}</small>
                    </div>
                @empty
                    <p>Aucune inscription.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Derniers besoins -->
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h5 class="m-0"><i class="bi bi-list-task"></i> 3 Derniers Besoins</h5>
            </div>
            <div class="card-body">
                @forelse($lastBesoins as $b)
                    <div class="border-bottom pb-2 mb-2">
                        <strong>{{ $b->etudiant->nom }} {{ $b->etudiant->prenom }}</strong><br>
                        <small>{{ Str::limit($b->description, 60) }}</small><br>
                        <small class="text-muted">{{ $b->date_soumission }}</small>
                    </div>
                @empty
                    <p>Aucun besoin.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection
