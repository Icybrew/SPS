@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('patients.prescriptions.show', $patient, $prescription) }}
@endcomponent
<section class="container my-5">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto">
@component('components.errors')
@endcomponent
@component('components.success')
@endcomponent
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $prescription->MedicalSubstance->name }}</h5>
                <p class="card-text">{{ $prescription->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Substance per dose: {{ $prescription->substance_in_dose . ' ' . $prescription->measurementUnit->unit }}</li>
                <li class="list-group-item">Doctor: {{ $prescription->doctor->firstname . ' ' . $prescription->doctor->lastname }}</li>
                <li class="list-group-item">Expires at: {{ ($prescription->expires_at !== NULL) ? $prescription->expires_at->format('Y-m-d')  : 'Never' }}</li>
            </ul>
@if(count($prescription->purchases) > 0)
            <div class="mt-3 mb-2 text-center">
                <h4>Purchases</h4>
            </div>
            <ul class="list-group list-group-flush">
@foreach($prescription->purchases as $purchase)
                <li class="list-group-item">
                    <div>
                        Purchased at: {{ $purchase->purchased_at }}
                    </div>
                    <div>
                        Sold by: {{ $purchase->pharmacist->firstname . ' ' . $purchase->pharmacist->lastname }}
                    </div>
                </li>
@endforeach
            </ul>
@else
            <div class="mt-3 mb-2 text-center">
                <h4>Prescription is not yet purchased</h4>
            </div>
@endif
        </div>
        <div class="my-3 d-flex">
            <div class="mr-auto">
                <a href="{{ route('patients.prescriptions.index', $patient->id) }}" class="mr-auto"><button type="button" class="btn btn-dark">&larr; All prescriptions</button></a>
            </div>
@can('create', SPS\PatientPrescriptionPurchase::class)
            <div class="ml-auto">
                <form action="{{ route('patients.prescriptions.purchase', ['patient_id' => $patient->id, 'prescription_id' => $prescription->id]) }}" method="post">
                    @csrf
                    <button type="submit" name="purchase" value="1" class="btn btn-primary">Mark as purchased</button>
                </form>
            </div>
@endcan
        </div>
    </div>
</section>
@endsection