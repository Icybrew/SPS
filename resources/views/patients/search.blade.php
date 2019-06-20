@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('patients.search') }}
@endcomponent
<section class="container my-5">
    <div class="col-xl-6 col-lg-7 col-md-10 col-sm-12 mx-auto">
@component('components.errors')
@endcomponent
        <div class="my-3">
            <h1 class="text-center">Search for patient</h1>
            <div class="my-4">
                <form action="{{ route('patients.search') }}" method="get">
                    <div class="form-group d-flex">
                        <input type="search" class="form-control" name="search" placeholder="SSN" required>
                        <span class="form-group-btn">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
@if(!empty($patients))
@if(count($patients) > 0)
        <ul class="list-group">
@foreach($patients as $patient)
            <li class="list-group-item mb-1 d-flex">
                <div class="my-auto">
                    ID: {{ $patient->id }}, <a href="{{ route('patients.show', $patient->id) }}">{{ $patient->firstname . ' ' . $patient->lastname }}</a>
                </div>
                <div class="my-auto ml-auto">
                    <a href="{{ route('patients.prescriptions.index', $patient->id) }}" class="d-inline-block mx-2" title="View prescriptions">
                        <h3 class="d-inline">
                            <i class="fas fa-prescription-bottle"></i>
                        </h3>
                    </a>
                    <a href="{{ route('patients.medical-history.index', $patient->id) }}" title="View medical history">
                        <h3 class="d-inline">
                            <i class="fas fa-file-medical-alt"></i>
                        </h3>
                    </a>
                </div>
            </li>
@endforeach
        </ul>
        <div class="pagination justify-content-center my-3">
            {{ $patients->links() }}
        </div>
@else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">There's no patients matching this criteria</h3>
        </div>
@endif
@else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">Use search box to find a patient</h3>
        </div>
@endif
    </div>
</section>
@endsection