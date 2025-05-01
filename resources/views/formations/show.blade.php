@extends('layouts.admin')

@section('content')
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('formations.participants') ? 'active' : '' }}"
           href="{{ route('formations.participants', $formation->id) }}">
            Participants list
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('formations.feedbacks') ? 'active' : '' }}"
           href="{{ route('formations.feedbacks', $formation->id) }}">
            Feedback list
        </a>
    </li>
</ul>
@endsection
