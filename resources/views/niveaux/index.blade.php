@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <h3 class="m-0">Liste des niveaux</h3>
        <a href="{{ route('niveaux.create') }}" class="btn btn-light">+ Nouveau</a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Langue</th>
                    <th>Frais Total</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($niveaux as $niveau)
                <tr>
                    <td>{{ $niveau->id_niveaux }}</td>
                    <td>{{ $niveau->nom_niveaux }}</td>
                    <td>{{ $niveau->langue }}</td>
                    <td>{{ number_format($niveau->frais_total, 2) }} FCFA</td>
                    <td>
                        <a href="{{ route('niveaux.edit', $niveau->id_niveaux) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form method="POST" action="{{ route('niveaux.destroy', $niveau->id_niveaux) }}"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Supprimer ?')" class="btn btn-danger btn-sm">
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

@endsection
