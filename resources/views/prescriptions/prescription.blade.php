@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 mx-auto">
        <div class="card">
@component('components.success')
@endcomponent
            <div class="card-body">
                <h5 class="card-title">{{ $prescription->MedicalSubstance->name }}</h5>
                <p class="card-text">{{ $prescription->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
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
                <h4>Prescription is not used</h4>
            </div>
@endif
        </div>
        <div class="mt-3">
            <a href="{{ url()->previous() }}" class="mr-auto"><button type="button" class="btn btn-dark">&larr; Go back</button></a>
        </div>
    </div>
</section>
@endsection