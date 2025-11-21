@extends('layouts.app')

@section('title', 'Ajouter un étudiant')

@section('content')

<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h3 >Ajouter un étudiant</h3>
    </div>
 
    <div class="card-body">
        <form action="{{ route('etudiants.store') }}" method="POST">
            @csrf

            @include('etudiants.partials.form')

            <button class="btn btn-success mt-3">Enregistrer</button>
            <a href="{{ route('etudiants.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>    
@endsection
