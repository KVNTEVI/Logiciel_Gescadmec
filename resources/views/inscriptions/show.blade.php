@extends('layouts.app')

@section('title', 'Détails inscription')

@section('content')

<div class="card shadow">
    <div class="card-header bg-info">
        <h3>Détails de l'inscription</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <p><strong>Étudiant :</strong> {{ $inscription->etudiant->nom }} {{ $inscription->etudiant->prenom }}</p>
            <p><strong>Niveau :</strong> {{ $inscription->niveau->nom_niveaux }}</p>
            <p><strong>Date inscription :</strong> {{ $inscription->date_inscription }}</p>
            <p><strong>Période :</strong> {{ $inscription->date_de_debut }} → {{ $inscription->date_de_fin }}</p>
            <p><strong>Total :</strong> {{ $inscription->montant_total }} FCFA</p>
            <p><strong>Versé :</strong> {{ $inscription->montant_verse }} FCFA</p>
            <p><strong>Restant :</strong> {{ $inscription->montant_restant }} FCFA</p>
            <p><strong>Statut :</strong> {{ $inscription->statut }}</p>
            <a href="{{ route('inscriptions.index') }}" class="btn btn-secondary mt-3">Retour</a>
        </div>
    </div>
</div>
@endsection
