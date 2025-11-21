@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="m-0">Liste des paiements</h4>
        <a href="{{ route('paiements.create') }}" class="btn btn-light">+ Nouveau paiement</a>
    </div>

    <div class="card-body">

        {{-- Barre de recherche --}}
       <form method="GET" action="{{ route('paiements.index') }}" class="row mb-3">

    <div class="col-md-4 mb-2">
        <input type="text" name="nom" class="form-control" 
               placeholder="Nom ou prénom" value="{{ request('nom') }}">
    </div>

    <div class="col-md-3 mb-2">
        <select name="mode_paiement" class="form-control">
            <option value="">-- Mode de paiement --</option>
            <option value="cash" {{ request('mode_paiement')=='cash' ? 'selected' : '' }}>Cash</option>
            <option value="mobile money" {{ request('mode_paiement')=='mobile money' ? 'selected' : '' }}>Mobile Money</option>
            <option value="virement" {{ request('mode_paiement')=='virement' ? 'selected' : '' }}>Virement</option>
        </select>
    </div>

    <div class="col-md-3 mb-2">
        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
    </div>

    <div class="col-md-2 mb-2">
        <button class="btn btn-primary w-100" type="submit">Rechercher</button>
    </div>
</form>


        {{-- Message de succès --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Montant</th>
                    <th>Mode de paiement</th>
                    <th>Date</th>
                    <th>Inscription</th>
                    <th class="text-center" width="260">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paiements as $p)
                <tr>
                    <td>{{ $p->id_paiement }}</td>
                    <td>{{ number_format($p->montant, 2) }} FCFA</td>
                    <td>{{ $p->mode_paiement }}</td>
                    <td>{{ $p->date_paiement }}</td>
                    <td>{{ $p->inscription->etudiant->nom ?? '' }} {{ $p->inscription->etudiant->prenoms ?? '' }}</td>

                    <td>
                        <div class="d-flex justify-content-between gap-1" role="group">

                            {{-- BTN Modifier --}}
                            <a href="{{ route('paiements.edit', $p->id_paiement) }}" class="btn btn-warning btn-sm w-100">
                                Modifier
                            </a>

                            {{-- BTN Supprimer --}}
                            <form action="{{ route('paiements.destroy', $p->id_paiement) }}"
                                method="POST" class="w-100">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Supprimer ?')" class="btn btn-danger btn-sm w-100">
                                    Supprimer
                                </button>
                            </form>

                            {{-- BTN Voir Reçu --}}
                            <a href="{{ route('paiements.recu', $p->id_paiement) }}" 
                                target="_blank" 
                                class="btn btn-info btn-sm w-100">
                                <i class="bi bi-receipt"></i> Reçu
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $paiements->links() }}
        </div>

    </div>
</div>
@endsection
