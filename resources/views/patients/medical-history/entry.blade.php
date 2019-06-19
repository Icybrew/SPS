@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('patients.medical-history.show', $patient, $entry) }}
@endcomponent
<section class="container my-5">
    <div class="col-xl-6 col-lg-7 col-md-10 col-sm-12 mx-auto">
        <div class="my-3">
            <h1 class="text-center">Entry #{{ $entry->id }}</h1>
        </div>
        <div class="card">
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
                <li class="list-group-item">Visit repeated: {{ $entry->visit_repeated === TRUE ? 'Yes' : 'No' }}</li>
                <li class="list-group-item">Visit compensated: {{ $entry->visit_compensated === TRUE ? 'Yes' : 'No' }}</li>
            </ul>
            <div class="card-body d-flex">
                <a href="{{ route('patients.medical-history.index', $patient->id) }}" class="mr-auto"><button type="button" class="btn btn-dark">&larr; Medical history</button></a>
            </div>
        </div>
    </div>
</section>
@endsection