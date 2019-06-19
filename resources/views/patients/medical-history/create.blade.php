@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('patients.medical-history.create', $patient) }}
@endcomponent
<section class="container my-5">
    <div class="my-5">
        <h1 class="text-center">New entry</h1>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 mx-auto">
        @component('components.errors')
        @endcomponent
        <form action="{{ route('patients.medical-history.store', $patient->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="inputDuration">Visit duration</label>
                <input type="number" class="form-control @error('duration') is-invalid @enderror" id="inputDuration" name="duration" value="{{ old('duration') ? old('duration') : NULL }}" min="1" placeholder="Visit duration" required>
                <small class="form-text text-muted ml-1">In minutes</small>
            </div>
            <div class="form-group">
                <label for="inputDiseaseCode">TLK-10 Disease code</label>
                <input type="text" class="form-control @error('disease_code') is-invalid @enderror" id="inputDiseaseCode" name="disease_code" value="{{ old('disease_code') ? old('disease_code') : NULL }}" placeholder="TLK-10 Disease code" required>
                <small class="form-text text-muted ml-1">Must match TLK-10 standard</small>
            </div>
            <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="inputDescription" name="description" placeholder="Description" required>{{ old('description') ? old('description') : NULL }}</textarea>
                <small class="form-text text-muted ml-1">Visit description</small>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="compensated" id="inputCompensated"{{ old('compensated') ? ' checked' : NULL }}>
                <label class="form-check-label" for="inputCompensated">Visit compensated</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="repeated" id="inputRepeated"{{ old('repeated') ? ' checked' : NULL }}>
                <label class="form-check-label" for="inputRepeated">Visit repeated</label>
            </div>
            <div class="mt-3 d-flex">
                <a href="{{ route('patients.medical-history.index', $patient->id) }}"><button type="button" class="btn btn-dark">&larr; Medical history</button></a>
                <button type="submit" class="btn btn-primary ml-auto">Create &rarr;</button>
            </div>
        </form>
    </div>
</section>
@endsection