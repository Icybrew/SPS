@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="card col-3 mx-auto">
@component('components.success')
@endcomponent
        <div class="card-body">
            <h5 class="card-title">{{ $entry->doctor->firstname . ' ' . $entry->doctor->lastname }}</h5>
            <p class="card-text">{{ $entry->description }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Disease code: {{ $entry->disease_code }}</li>
            <li class="list-group-item">Visit duration: {{ $entry->visit_duration }} min</li>
            <li class="list-group-item">Visited at: {{ $entry->visited_at }}</li>
            <li class="list-group-item">Visit repeated: {{ $entry->visited_at ? 'Yes' : 'No' }}</li>
        </ul>
        <div class="card-body d-flex">
            <a href="{{ url()->previous() }}" class="mr-auto"><button type="button" class="btn btn-dark">&larr; Go back</button></a>
        </div>
    </div>
</section>
@endsection