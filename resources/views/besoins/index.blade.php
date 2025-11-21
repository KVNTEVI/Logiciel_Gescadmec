@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <h4 class="m-0">Liste des besoins</h4>
        <a href="{{ route('besoins.create') }}" class="btn btn-light">+ Nouveau besoin</a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('besoins.index') }}" method="GET" class="mb-3 d-flex">
            <div class="d-flex w-100">
            <input type="text" name="search" value="{{ request('search') }}" 
                class="form-control me-2" placeholder="Rechercher par nom ou prénom d'étudiant">
            <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>


        <div class="table-responsive"> 
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark" style="position: sticky; top: 0; z-index: 10;">
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Étudiant</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>

            <tbody>
            @foreach($besoins as $b)
                <tr>
                    <td>{{ $b->id_besoin }}</td>
                    {{-- Utilisation de e() pour échapper le contenu et Str::limit pour raccourcir --}}
                    <td>{{ html_entity_decode(Str::limit($b->description, 40)) }}</td>
                    {{-- Formatage simple de la date pour un affichage propre --}}
                    <td>{{ \Carbon\Carbon::parse($b->date_soumission)->format('d/m/Y') }}</td>
                    <td>{{ $b->etudiant->nom }} {{ $b->etudiant->prenom }}</td>

                    <td class="d-flex justify-content-between gap-1">
                        <a href="{{ route('besoins.show', $b->id_besoin) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('besoins.edit', $b->id_besoin) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form action="{{ route('besoins.destroy', $b->id_besoin) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Supprimer ce besoin ?')" class="btn btn-danger btn-sm">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>


    </div>
</div>

@endsection
