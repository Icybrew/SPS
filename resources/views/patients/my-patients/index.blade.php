@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('patients.my-patients.index') }}
@endcomponent
<section class="container my-5">
    <div class="col-xl-6 col-lg-7 col-md-10 col-sm-12 mx-auto">
@component('components.errors')
@endcomponent
        <div class="my-3">
            <h1 class="text-center">My patients</h1>
            <div class="my-4">
                <form action="{{ route('patients.my-patients.index') }}" method="get">
                    <div class="input-group d-flex">
                        <input type="search" class="form-control" name="search" placeholder="Firstname / Lastname / SSN / Disease code">
                        <span class="input-group-prepend">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
@if(!empty($patients) && count($patients) > 0)
        <ul class="list-group">
@foreach($patients as $patient)
            <li class="list-group-item mb-1 d-flex">
                <div class="my-auto">
                    ID: {{ $patient->id }}, <a href="{{ route('patients.show', $patient->id) }}">{{ $patient->firstname . ' ' . $patient->lastname }}</a>
                </div>
                <div class="my-auto ml-auto">
@can('create', SPS\PatientPrescription::class)
                    <a href="{{ route('patients.prescriptions.create', $patient->id) }}" class="d-inline-block mx-2" title="Write a prescription">
                        <h3 class="d-inline">
                            <i class="fas fa-prescription-bottle-alt"></i>
                        </h3>
                    </a>
@endcan
@can('create', SPS\PatientMedicalHistory::class)
                    <a href="{{ route('patients.medical-history.create', $patient->id) }}" title="Create a new medical entry">
                        <h3 class="d-inline">
                            <i class="fas fa-file-medical"></i>
                        </h3>
                    </a>
@endcan
                </div>
            </li>
@endforeach
        </ul>
        <div class="my-3 d-flex">
            <div class="mr-auto">
                <a href="{{ route('patients.index') }}" class="mr-auto"><button type="button" class="btn btn-dark">&larr; All patients</button></a>
            </div>
            <div class="ml-auto">
                <a href="{{ route('patients.my-patients.export', $patient->id) }}" class="card-link"><button type="button" class="btn btn-primary">Export</button></a>
            </div>
        </div>
        <div class="pagination justify-content-center my-3">
            {{ $patients->links() }}
        </div>
@else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">You have 0 assigned patients</h3>
        </div>
@endif
    </div>
</section>
@endsection