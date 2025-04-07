@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="text-primary">Edit Training</h2>
    <form action="{{ route('formations.update', $formation->id_formation) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="Titre" class="form-control" value="{{ $formation->titre }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="Description" class="form-control" required>{{ $formation->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Date_Debut</label>
            <input type="date" name="Date_Debut" class="form-control" value="{{ $formation->date_debut }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date_Fin</label>
            <input type="date" name="Date_Fin" class="form-control" value="{{ $formation->date_fin }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre de Place</label>
            <input type="number" name="Nombre de Place" class="form-control" value="{{ $formation->nbr_Place }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <input type="text" name="type" class="form-control" value="{{ $formation->type }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Formateur</label>
            <input type="text" name="formateur" class="form-control" value="{{ $formation->formateur }}" required>
        </div>
        <button type="submit" class="btn btn-success">Modifier</button>
        <a href="{{ route('formations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
