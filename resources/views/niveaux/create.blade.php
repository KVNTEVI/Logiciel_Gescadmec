@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h3>Ajouter un niveau</h3>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('niveaux.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nom du niveau</label>
                <input type="text" name="nom_niveaux" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Langue</label>
                <input type="text" name="langue" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Frais total</label>
                <input type="number" step="0.01" name="frais_total" class="form-control" required>
            </div>

            <button class="btn btn-success">Enregistrer</button>
            <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">Annuler</a>

        </form>

    </div>
</div>
@endsection
