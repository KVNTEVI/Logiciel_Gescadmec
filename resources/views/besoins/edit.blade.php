@extends('layouts.app') 

{{-- Indique à Laravel Blade d'étendre la mise en page principale nommée 'app'. --}}

@section('content')

{{-- Début du contenu spécifique à cette page. --}}

<div class="card shadow">
    {{-- Début de la carte (composant Bootstrap) avec une ombre. --}}
    
    <div class="card-header bg-warning">
        {{-- En-tête de la carte : fond jaune/orange (bg-warning) signalant une opération de modification. --}}
        <h4 class="m-0 text-white">Modifier le besoin</h4>
        {{-- Titre de l'en-tête (text-white assure la lisibilité sur le fond warning). --}}
    </div>

    <div class="card-body">
        {{-- Corps de la carte, contenant le formulaire d'édition. --}}

        <form method="POST" action="{{ route('besoins.update', $besoin->id_besoin) }}">
            {{-- Début du formulaire :
                 - method="POST" : Tous les navigateurs supportent uniquement GET et POST pour les formulaires HTML.
                 - action="..." : La route cible est 'besoins.update'. Elle nécessite l'ID du besoin ($besoin->id_besoin) pour identifier la ressource à mettre à jour. --}}
            
            @csrf
            {{-- Directive Blade pour la sécurité (jeton CSRF). --}}
            
            @method('PUT')
            {{-- Directive Blade essentielle pour l'édition. Laravel traduit le POST du formulaire en une requête HTTP de type PUT, 
                 qui est la méthode RESTful standard pour la mise à jour complète d'une ressource. --}}

            <div class="mb-3">
                <label class="form-label">Description *</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $besoin->description }}</textarea>
                {{-- Pré-remplissage : La valeur actuelle ($besoin->description) est insérée entre les balises <textarea> pour s'assurer que le champ affiche la donnée existante. --}}
            </div>

            <div class="mb-3">
                <label class="form-label">Date de soumission *</label>
                <input type="date" name="date_soumission" class="form-control" value="{{ $besoin->date_soumission }}" required>
                {{-- Pré-remplissage : La valeur actuelle ($besoin->date_soumission) est insérée dans l'attribut 'value' de l'input. --}}
            </div>

            <div class="mb-3">
                <label class="form-label">Étudiant *</label>
                <select name="id_etudiant" class="form-control" required>
                    {{-- Liste déroulante pour la clé étrangère (l'étudiant lié). --}}
                    
                    @foreach($etudiants as $e)
                    {{-- Boucle Blade : itère sur tous les étudiants disponibles. --}}
                        <option value="{{ $e->id_etudiant }}" 
                            @if($e->id_etudiant == $besoin->id_etudiant) selected @endif>
                            {{-- Logique de sélection : Cette condition vérifie si l'ID de l'étudiant courant ($e->id_etudiant) correspond à l'ID de l'étudiant actuellement lié au besoin ($besoin->id_etudiant). --}}
                            {{-- Si la condition est vraie, l'attribut 'selected' est ajouté à la balise <option>, pré-sélectionnant la bonne valeur dans la liste. --}}
                            {{ $e->nom }} {{ $e->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-warning">Mettre à jour</button>
            {{-- Bouton de soumission pour la mise à jour. --}}
        </form>

    </div>
</div>

@endsection
{{-- Fin de la section 'content'. --}}