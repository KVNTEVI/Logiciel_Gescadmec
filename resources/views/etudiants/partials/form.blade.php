<div class="row">
    <div class="col-md-6">
        <label class="form-label">Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom', $etudiant->nom ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Prénom</label>
        <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $etudiant->prenom ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Sexe</label>
        <select name="sexe" class="form-select" required>
            <option value="">-- Choisir --</option>
            <option value="Masculin" {{ old('sexe', $etudiant->sexe ?? '') == 'Masculin' ? 'selected' : '' }}>Masculin</option>
            <option value="Féminin" {{ old('sexe', $etudiant->sexe ?? '') == 'Féminin' ? 'selected' : '' }}>Féminin</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Date de naissance</label>
        <input type="date" name="date_de_naissance" class="form-control" value="{{ old('date_de_naissance', $etudiant->date_de_naissance ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Téléphone</label>
        <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $etudiant->telephone ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $etudiant->email ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Adresse</label>
        <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $etudiant->adresse ?? '') }}">
    </div>
</div>
