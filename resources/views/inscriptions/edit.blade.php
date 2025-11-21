@extends('layouts.app')

@section('title', 'Modifier inscription')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning">
        <h3>Modifier inscription</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('inscriptions.update', $inscription->id_inscription) }}" method="POST">
            @csrf
            @method('PUT')

            @include('inscriptions.partials.form', ['inscription' => $inscription])

            <button class="btn btn-warning mt-3">Mettre à jour</button>
            <a href="{{ route('inscriptions.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>
@endsection
