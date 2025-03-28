@extends('layouts.admin')

@section('content')
<!-- resources/views/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
</head>
<body>
    <h1>Bienvenue sur le Dashboard</h1>
    

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

   <!-- <a href="{{ route('logout') }}">Déconnexion</a>-->
</body>
</html>
@endsection