@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="text-primary">Add New Training</h2>
    <form action="{{ route('formations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="Titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="Description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="DateDebut" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="DateFin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Number of Places</label>
            <input type="number" name="nbrPlace" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Training</button>
        <a href="{{ route('formations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
