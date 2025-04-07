@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">📌 Ajouter une Formation</h2>
        <a href="{{ route('formations.index') }}" class="btn btn-secondary">⬅ Retour à la Liste</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('formations.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text" name="titre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de début</label>
                    <input type="date" name="date_debut" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de fin</label>
                    <input type="date" name="date_fin" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre de places</label>
                    <input type="number" name="nbr_place" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <input type="text" name="type" class="form-control" required>
                </div>

                <!-- Sélection du type de formateur -->
                <div class="mb-3">
                    <label class="form-label">Type de Formateur</label>
                    <select name="formateur_type" id="formateur_type" class="form-control" required>
                        <option value="">Sélectionner...</option>
                        <option value="interne">Formateur Interne</option>
                        <option value="externe">Formateur Externe</option>
                    </select>
                </div>

                <!-- Sélection du formateur interne -->
                <div class="mb-3 d-none" id="formateur_interne_section">
                    <label class="form-label">Sélectionner un formateur interne</label>
                    <select name="formateur_interne" class="form-control">
                        <option value="">Choisir un formateur</option>
                        @foreach($users as $user)
                            <option value="{{ $user->prenom }}">{{ $user->prenom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Champ pour le formateur externe -->
                <div class="mb-3 d-none" id="formateur_externe_section">
                    <label class="form-label">Nom du formateur externe</label>
                    <input type="text" name="formateur_externe" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">✔ Ajouter la formation</button>
                <a href="{{ route('formations.index') }}" class="btn btn-secondary">❌ Annuler</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('formateur_type').addEventListener('change', function() {
        let interneSection = document.getElementById('formateur_interne_section');
        let externeSection = document.getElementById('formateur_externe_section');
        let formateurExterneInput = document.querySelector('input[name="formateur_externe"]');
        let formateurInterneSelect = document.querySelector('select[name="formateur_interne"]');

        if (this.value === 'interne') {
            interneSection.classList.remove('d-none');
            externeSection.classList.add('d-none');
            formateurExterneInput.value = ""; // Réinitialiser le champ externe
        } else if (this.value === 'externe') {
            externeSection.classList.remove('d-none');
            interneSection.classList.add('d-none');
            formateurInterneSelect.value = ""; // Réinitialiser le champ interne
        } else {
            interneSection.classList.add('d-none');
            externeSection.classList.add('d-none');
        }
    });
</script>
@endsection
