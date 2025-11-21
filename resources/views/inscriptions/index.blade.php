@extends('layouts.app')


@section('content')

 <div class="card shadow ">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <h3>Inscriptions</h3>
        <a href="{{ route('inscriptions.create') }}" class="btn btn-light">+ Nouvelle inscription</a>
    </div>

   <div class="card-body"> 

        <form method="GET" action="{{ route('inscriptions.index') }}" class="mb-3">
            <div class="row">

                <div class="col-md-4">
                    <input type="text" name="nom" value="{{ $nom }}" class="form-control"
                        placeholder="Rechercher par nom d'étudiant">
                </div>

                 <div class="col-md-3">
                <select name="niveau" class="form-control">
                    <option value="">-- Tous les niveaux --</option>
                    @foreach($niveauxList as $n)
                        <option value="{{ $n->id_niveaux }}" {{ $niveau == $n->id_niveaux ? 'selected' : '' }}>
                            {{ $n->nom_niveaux }}
                        </option>
                    @endforeach
                </select>
                </div>

                <div class="col-md-3">
                    <select name="statut" class="form-control">
                        <option value="">-- Tous les statuts --</option>
                        <option value="payé" {{ $statut == 'payé' ? 'selected' : '' }}>Payé</option>
                        <option value="en cours" {{ $statut == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="terminée" {{ $statut == 'terminée' ? 'selected' : '' }}>Terminée</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex">
                    <button type="submit" class="btn btn-primary me-2">Rechercher</button>
                    
                </div>
            </div>
        </form>

        {{-- 🚫 Styles de hauteur/défilement retirés ici 🚫 --}}
        <div class="table-responsive"> 
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark" style="position: sticky; top: 0; z-index: 10;">
                    <tr>
                        <th>ID</th>
                        <th>Date Inscription</th>
                        <th>Étudiant</th>
                        <th>Niveau</th>
                        <th>Total</th>
                        <th>Versé</th>
                        <th>Restant</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($inscriptions as $i)
                    <tr>
                        <td>{{ $i->id_inscription }}</td>
                        <td>{{ \Carbon\Carbon::parse($i->date_inscription)->format('d/m/Y') }}</td>
                        <td>{{ $i->etudiant->nom }} {{ $i->etudiant->prenom }}</td>
                        <td>{{ $i->niveau->nom_niveaux }}</td>
                        <td>{{ number_format($i->montant_total, 0, ',', ' ') }} FCFA</td>
                        <td>{{ number_format($i->montant_verse, 0, ',', ' ') }} FCFA</td>
                        <td>{{ number_format($i->montant_restant, 0, ',', ' ') }} FCFA</td>
                        <td>
                            <span class="badge bg-{{ $i->statut == 'payé' ? 'success' : ($i->statut == 'en cours' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($i->statut) }}
                            </span>
                        </td>
                        <td class="d-flex justify-content-between gap-1">
                            <a href="{{ route('inscriptions.show', $i->id_inscription) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('inscriptions.edit', $i->id_inscription) }}" class="btn btn-warning btn-sm">Modifier</a>

                            <form action="{{ route('inscriptions.destroy', $i->id_inscription) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Supprimer cette inscription ?')" class="btn btn-danger btn-sm">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $inscriptions->links() }}

    </div>
</div>
@endsection