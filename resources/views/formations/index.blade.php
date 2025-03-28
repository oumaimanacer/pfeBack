@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-danger">List of Training</h1>
    <a href="{{ route('formations.create') }}" class="btn btn-primary">Add Training</a>
    <table class="table table-bordered mt-3">
        <thead class="bg-light">
            <tr>
                
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Number of Places</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formations as $formation)
            <tr>
                <td>{{ $formation->Titre }}</td>
                <td>{{ $formation->Description }}</td>
                <td>{{ $formation->DateDebut }}</td>
                <td>{{ $formation->DateFin }}</td>
                <td>{{ $formation->nbrPlace }}</td>
                <td>{{ $formation->type }}</td>
                <td>
                    <a href="{{ route('formations.edit', ['id' => $formation->id]) }}" class="btn btn-warning btn-sm">✏️</a>
                    <form action="{{ route('formations.destroy',  ['id' => $formation->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">🗑</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
