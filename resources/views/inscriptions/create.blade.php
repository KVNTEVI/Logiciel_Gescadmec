@extends('layouts.app')

@section('title', 'Nouvelle inscription')

@section('content')

<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h3>Nouvelle inscription</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('inscriptions.store') }}" method="POST">
            @csrf

            @include('inscriptions.partials.form')

            <button class="btn btn-success mt-3">Enregistrer</button>
            <a href="{{ route('inscriptions.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form> 
    </div>
</div>
@endsection
