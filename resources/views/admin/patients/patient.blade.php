@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="card col-3 mx-auto">
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
            <li class="list-group-item">Updated at: {{ $patient->updated_at }}</li>
        </ul>
        <div class="card-body d-flex">
            <a href="{{ route('admin.patients.index') }}" class="mr-auto"><button type="button" class="btn btn-dark">&larr; Go back</button></a>
            <div>
                <a href="{{ route('admin.patients.edit', $patient->id) }}" class="card-link"><button type="button" class="btn btn-primary">Edit</button></a>
                <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection