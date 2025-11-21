@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning">
        <h3>Modifier le niveau</h3>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('niveaux.update', $niveau->id_niveaux) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nom du niveau</label>
                <input type="text" name="nom_niveaux" value="{{ $niveau->nom_niveaux }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Langue</label>
                <input type="text" name="langue" value="{{ $niveau->langue }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Frais total</label>
                <input type="number" step="0.01" name="frais_total" value="{{ $niveau->frais_total }}" class="form-control">
            </div>

            <button class="btn btn-warning">Mettre à jour</button>
            <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">Annuler</a>

        </form>

    </div>
</div>
@endsection
