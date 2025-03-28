@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="text-primary">Edit Training</h2>
    <form action="{{ route('formations.update', $formation->id_formation) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="Titre" class="form-control" value="{{ $formation->Titre }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="Description" class="form-control" required>{{ $formation->Description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="DateDebut" class="form-control" value="{{ $formation->DateDebut }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="DateFin" class="form-control" value="{{ $formation->DateFin }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Number of Places</label>
            <input type="number" name="nbrPlace" class="form-control" value="{{ $formation->nbrPlace }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <input type="text" name="type" class="form-control" value="{{ $formation->type }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Training</button>
        <a href="{{ route('formations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
