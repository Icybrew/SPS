@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('patients.prescriptions.index', $patient) }}
@endcomponent
<section class="container my-5">
    <div class="col-xl-6 col-lg-7 col-md-10 col-sm-12 my-auto mx-auto">
        <div class="my-3">
            <h1 class="text-center">{{ $patient->firstname . ' ' . $patient->lastname }}</h1>
            <h1 class="text-center">Prescriptions</h1>
        </div>
@component('components.success')
@endcomponent
@if(!empty($prescriptions) && count($prescriptions) > 0)
        <ul class="list-group">
@foreach($prescriptions as $prescription)
            <li class="list-group-item my-1 {{ ($prescription->expires_at !== NULL && date('Y-m-d') > $prescription->expires_at) ? 'list-group-item-danger' : '' }}">
                <div>
                    Substance: {{ $prescription->medicalSubstance->name }}
                </div>
                <div>
                    Issued by: {{ $prescription->doctor->firstname . ' ' . $prescription->doctor->lastname }}
                </div>
                <div>
                    Expires: {{ ($prescription->expires_at !== NULL) ? $prescription->expires_at->format('Y-m-d') : 'Never'  }}
                </div>
@can('view', $prescription)
                <div class="text-right">
                    <a href="{{ route('patients.prescriptions.show', [$patient->id, $prescription->id]) }}"><button type="button" class="btn btn-primary">See details</button></a>
                </div>
@endcan
            </li>
@endforeach
        </ul>
        <div class="pagination justify-content-center my-3">
            {{ $prescriptions->links() }}
        </div>
@else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">No prescriptions</h3>
        </div>
@endif
        <div class="d-flex mx-2">
@can('view', $patient)
            <div class="mr-auto">
                <a href="{{ route('patients.show', $patient->id) }}"><button type="button" class="btn btn-dark">&larr; Patients profile</button></a>
            </div>
@endcan
@can('create', SPS\PatientPrescription::class)
            <div class="ml-auto">
                <a href="{{ route('patients.prescriptions.create', $patient->id) }}"><button type="button" class="btn btn-success">Prescribe medicine &rarr;</button></a>
            </div>
@endcan
        </div>
    </div>
</section>
@endsection