@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="text-danger">Modifier un Employé</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom }}" required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">Sélectionner un rôle</option>
                        <option value="SuperAdmin" {{ $user->role == 'SuperAdmin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Employe" {{ $user->role == 'Employe' ? 'selected' : '' }}>Employé</option>
                        <option value="Responsable RH" {{ $user->role == 'Responsable RH' ? 'selected' : '' }}>Responsable RH</option>
                        <option value="Formateur_interne" {{ $user->role == 'Formateur_interne' ? 'selected' : '' }}>Formateur interne</option>
                        <option value="Formateur_externe" {{ $user->role == 'Formateur_externe' ? 'selected' : '' }}>Formateur externe</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="poste" class="form-label">Poste</label>
                    <input type="text" class="form-control" id="poste" name="poste" value="{{ $user->poste }}">
                </div>

                <div class="mb-3">
                    <label for="dateEmbauche" class="form-label">Date d'embauche</label>
                    <input type="date" class="form-control" id="dateEmbauche" name="dateEmbauche" value="{{ $user->dateEmbauche }}">
                </div>

                <div class="mb-3">
                    <label for="entreprise" class="form-label">Entreprise</label>
                    <input type="text" class="form-control" id="entreprise" name="entreprise" value="{{ $user->entreprise }}">
                </div>

                <button type="submit" class="btn btn-success">Modifier</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
