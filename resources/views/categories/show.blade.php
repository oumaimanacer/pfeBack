@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Category Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name:</h5>
            <p class="card-text">{{ $category->name }}</p>
        </div>
    </div>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Back to list</a>
</div>
@endsection
