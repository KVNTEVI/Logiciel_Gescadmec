@extends('layouts.app')

@section('title', 'Détails étudiant')

@section('content')
<div class="card shadow">
    <div class="card-header bg-info">
         <h3>Détails de l'étudiant</h3>
    </div>
   
    <div class="card">
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $etudiant->nom }}</p>
            <p><strong>Prénom :</strong> {{ $etudiant->prenom }}</p>
            <p><strong>Sexe :</strong> {{ $etudiant->sexe }}</p>
            <p><strong>Date naissance :</strong> {{ $etudiant->date_de_naissance }}</p>
            <p><strong>Tel :</strong> {{ $etudiant->telephone }}</p>
            <p><strong>Email :</strong> {{ $etudiant->email }}</p>
            <p><strong>Adresse :</strong> {{ $etudiant->adresse }}</p>
            <p><strong>Date d’enregistrement :</strong> {{ $etudiant->date_enregistrement }}</p>
            <a href="{{ route('etudiants.index') }}" class="btn btn-secondary mt-3">Retour</a>
        </div>
    </div>
</div>

@endsection
