@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('patients.medical-history.index', $patient) }}
@endcomponent
<section class="container my-5">
    <div class="col-xl-6 col-lg-7 col-md-10 col-sm-12 my-auto mx-auto">
        <div class="my-3">
            <h1 class="text-center">{{ $patient->firstname . ' ' . $patient->lastname }}</h1>
            <h1 class="text-center">Medical history</h1>
        </div>
@component('components.success')
@endcomponent
@if(!empty($medicalHistory) && count($medicalHistory) > 0)
        <ul class="list-group">
@foreach($medicalHistory as $entry)
            <li class="list-group-item my-1">
                <div>
                    Disease code: {{ $entry->disease_code }}
                </div>
                <div>
                    Visit date: {{ $entry->visited_at }}
                </div>
                <div>
                    Doctor: {{ $entry->doctor->firstname . ' ' . $entry->doctor->lastname }}
                </div>
                <div class="text-right">
                    <a href="{{ route('patients.medical-history.show', [$patient->id, $entry->id]) }}"><button type="button" class="btn btn-primary">See details</button></a>
                </div>
            </li>
@endforeach
        </ul>
        <div class="pagination justify-content-center my-3">
            {{ $medicalHistory->links() }}
        </div>
@else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">No entries</h3>
        </div>
@endif
        <div class="d-flex mx-2">
            <div class="mr-auto">
                <a href="{{ route('patients.show', $patient->id) }}"><button type="button" class="btn btn-dark">&larr; Patients profile</button></a>
            </div>
            <div class="ml-auto">
                <a href="{{ route('patients.medical-history.create', $patient->id) }}"><button type="button" class="btn btn-success">Create entry &rarr;</button></a>
            </div>
        </div>
    </div>
</section>
@endsection