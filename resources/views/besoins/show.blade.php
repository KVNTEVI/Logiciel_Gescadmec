@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header bg-info text-white">
        <h4 class="m-0">Détails du besoin</h4>
    </div>

    <div class="card-body">

        <p><strong>ID :</strong> {{ $besoin->id_besoin }}</p>
        <p><strong>Description :</strong> {{ $besoin->description }}</p>
        <p><strong>Date :</strong> {{ $besoin->date_soumission }}</p>
        <p><strong>Étudiant :</strong> 
            {{ $besoin->etudiant->nom }} {{ $besoin->etudiant->prenom }}
        </p>

        <a href="{{ route('besoins.index') }}" class="btn btn-secondary">Retour</a>

    </div>
</div>

@endsection
