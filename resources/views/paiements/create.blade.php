@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4>Enregistrer un paiement</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('paiements.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Montant</label>
                <input type="number" step="0.01" name="montant" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mode de paiement</label>
                <select name="mode_paiement" class="form-control" required>
                    <option value="">-- Choisir --</option>
                    <option value="Espèce">Espèce</option>
                    <option value="Mobile Money">Mobile Money</option>
                    <option value="Virement">Virement</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Date du paiement</label>
                <input type="date" name="date_paiement" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Inscription</label>
                <select name="id_inscription" class="form-control" required>
                    <option value="">-- Sélectionner l'inscription --</option>

                    @foreach($inscriptions as $i)
                        <option value="{{$i->id_inscription}}">
                            {{ $i->etudiant->nom ?? '' }} {{ $i->etudiant->prenom ?? '' }}
                        </option>
                    @endforeach

                </select>
            </div>

            <button class="btn btn-success">Enregistrer</button>
            <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Annuler</a>

        </form>

    </div>
</div>
@endsection
