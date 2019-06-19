@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('patients.show', $patient) }}
@endcomponent
<section class="container my-5">
    <div class="col-xl-6 col-lg-7 col-md-10 col-sm-12 mx-auto">
        <div class="my-3">
            <h1 class="text-center">Patient</h1>
        </div>
        <div class="card mx-auto">
@component('components.success')
@endcomponent
            <div class="card-body">
                <h5 class="card-title">{{ $patient->firstname . ' ' . $patient->lastname }}</h5>
                <p class="card-text">SSN - {{ !empty($patient->extraInfoPatient->ssn) ? $patient->extraInfoPatient->ssn : 'Not specified' }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Email: {{ $patient->email }}</li>
                <li class="list-group-item">Birthday: {{ !empty($patient->birthday) ? $patient->birthday : 'Not specified' }}</li>
                <li class="list-group-item">Registered at: {{ $patient->created_at }}</li>
            </ul>
        </div>
        <div class="m-3 d-flex">
            <div class="mr-auto">
                <a href="{{ route('patients.index') }}" class="mr-auto"><button type="button" class="btn btn-dark">&larr; All patients</button></a>
            </div>
            <div class="ml-auto">
                <a href="{{ route('patients.medical-history.index', $patient->id) }}" class="card-link"><button type="button" class="btn btn-primary">Medical history</button></a>
                <a href="{{ route('patients.prescriptions.index', $patient->id) }}" class="card-link"><button type="button" class="btn btn-primary">Prescriptions</button></a>
            </div>
        </div>
    </div>
</section>
@endsection