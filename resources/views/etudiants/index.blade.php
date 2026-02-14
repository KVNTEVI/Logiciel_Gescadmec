@extends('layouts.app')

@section('title', 'Liste des étudiants')

@section('content')

<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <h3 class="m-0">Liste des étudiants</h3>
        <a href="{{ route('etudiants.create') }}" class="btn btn-light">+ Ajouter un étudiant</a>
    </div>

    <div class="card-body">

        {{-- Barre de recherche --}}
        <form action="{{ route('etudiants.index') }}" method="GET" class="mb-3 d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                class="form-control" placeholder="Rechercher par nom ou prénom">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('etudiants.index') }}" class="btn btn-outline-secondary">Effacer</a>
            @endif
        </form>
                <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom complet</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Sexe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($etudiants as $etud)
                    <tr>
                        <td>{{ $etud->id_etudiant }}</td>
                        <td>{{ $etud->nom }} {{ $etud->prenom }}</td>
                        <td>{{ $etud->telephone }}</td>
                        <td>{{ $etud->email }}</td>
                        <td>{{ $etud->sexe }}</td>
                        <td>
                            <a href="{{ route('etudiants.show', $etud->id_etudiant) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('etudiants.edit', $etud->id_etudiant) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('etudiants.destroy', $etud->id_etudiant) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Supprimer ?')" class="btn btn-danger btn-sm">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucun étudiant trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination avec conservation de la recherche --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $etudiants->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>    
</div>
@endsection
