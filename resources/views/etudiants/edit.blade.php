@extends('layouts.app')

@section('title', 'Modifier étudiant')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning">
        <h3>Modifier étudiant</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('etudiants.update', $etudiant->id_etudiant) }}" method="POST">
            @csrf @method('PUT')

            @include('etudiants.partials.form', ['etudiant' => $etudiant])

            <button class="btn btn-warning mt-3">Mettre à jour</button>
            <a href="{{ route('etudiants.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>
@endsection
