@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4 class="m-0">Nouveau besoin</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('besoins.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Description *</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Date de soumission *</label>
                <input type="date" name="date_soumission" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Étudiant *</label>
                <select name="id_etudiant" class="form-control" required>
                    <option value="">-- sélectionnez --</option>
                    @foreach($etudiants as $e)
                        <option value="{{ $e->id_etudiant }}">
                            {{ $e->nom }} {{ $e->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">Enregistrer</button>
        </form>

    </div>
</div>

@endsection
