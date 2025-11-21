@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning">
        <h4>Modifier le paiement</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('paiements.update', $paiement->id_paiement) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Montant</label>
                <input type="number" step="0.01" name="montant" value="{{ $paiement->montant }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Mode de paiement</label>
                <select name="mode_paiement" class="form-control">
                    <option {{ $paiement->mode_paiement == 'Espèce' ? 'selected' : '' }}>Espèce</option>
                    <option {{ $paiement->mode_paiement == 'Mobile Money' ? 'selected' : '' }}>Mobile Money</option>
                    <option {{ $paiement->mode_paiement == 'Virement' ? 'selected' : '' }}>Virement</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Date du paiement</label>
                <input type="date" name="date_paiement" value="{{ $paiement->date_paiement }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Inscription</label>
                <select name="id_inscription" class="form-control">

                    @foreach($inscriptions as $i)
                        <option value="{{ $i->id_inscription }}"
                            {{ $paiement->id_inscription == $i->id_inscription ? 'selected' : '' }}>
                            Inscription #{{ $i->id_inscription }}
                        </option>
                    @endforeach

                </select>
            </div>

            <button class="btn btn-warning">Mettre à jour</button>
            <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Annuler</a>

        </form>

    </div>
</div>
@endsection
