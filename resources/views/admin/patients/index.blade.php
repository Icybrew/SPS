@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="container mx-auto">
        <div class="my-3">
            <h1 class="text-center">Patients</h1>
        </div>
@if(!empty($patients) && count($patients) > 0)
        <ul class="list-group col-xl-6 col-lg-7 col-md-10 col-sm-12 my-auto mx-auto">
@foreach($patients as $patient)
            <li class="list-group-item">ID: {{ $patient->id }}, <a href="{{ route('admin.patients.show', $patient->id) }}">{{ $patient->firstname . ' ' . $patient->lastname }}</a> - {{ $patient->email }} </li>
@endforeach
        </ul>
        <div class="pagination justify-content-center my-3">
            {{ $patients->links() }}
        </div>
@else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">There are 0 patients</h3>
        </div>
@endif
        <div class="text-center my-3">
            <a href="{{ route('admin.patients.create') }}"><button type="button" class="btn btn-lg btn-primary">Create new patient</button></a>
        </div>
    </div>
</section>
@endsection