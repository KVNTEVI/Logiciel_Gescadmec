<div class="row">
    <div class="col-md-4">
        <label class="form-label">Date d'inscription</label>
        <input type="date" class="form-control" name="date_inscription"
               value="{{ old('date_inscription', $inscription->date_inscription ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Date de début</label>
        <input type="date" class="form-control" name="date_de_debut"
               value="{{ old('date_de_debut', $inscription->date_de_debut ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Date de fin</label>
        <input type="date" class="form-control" name="date_de_fin"
               value="{{ old('date_de_fin', $inscription->date_de_fin ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Montant total (FCFA)</label>
        <input type="number" class="form-control" name="montant_total"
               value="{{ old('montant_total', $inscription->montant_total ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Montant versé (FCFA)</label>
        <input type="number" class="form-control" name="montant_verse"
               value="{{ old('montant_verse', $inscription->montant_verse ?? '0') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Étudiant</label>
        <select class="form-select" name="id_etudiant" required>
            <option value="">-- Choisir un étudiant --</option>
            @foreach ($etudiants as $e)
                <option value="{{ $e->id_etudiant }}"
                        {{ old('id_etudiant', $inscription->id_etudiant ?? '') == $e->id_etudiant ? 'selected' : '' }}>
                    {{ $e->nom }} {{ $e->prenom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Niveau</label>
        <select class="form-select" name="id_niveaux" required>
            <option value="">-- Choisir un niveau --</option>
            @foreach ($niveaux as $n)
                <option value="{{ $n->id_niveaux }}"
                        {{ old('id_niveaux', $inscription->id_niveaux ?? '') == $n->id_niveaux ? 'selected' : '' }}>
                    {{ $n->langue }} {{ $n->nom_niveaux }}
                </option>
            @endforeach
        </select>
    </div>
</div>
