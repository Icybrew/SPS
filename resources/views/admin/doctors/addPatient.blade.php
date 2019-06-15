@extends('layouts.main')

@section('content')
<section class="container my-5">
    <div class="my-5">
        <h1 class="text-center">{{ $doctor->firstname . ' ' . $doctor->lastname }}</h1>
        <h1 class="text-center">Assign patient</h1>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 mx-auto">
@component('components.errors')
@endcomponent
        <form action="{{ route('admin.doctors.patients.store', $doctor->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="patient">Patient</label>
                <select class="form-control @error('patient') is-invalid @enderror" id="selectPatient" name="patient" required>
                    <option selected disabled hidden>Please select patient</option>
@foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->firstname . ' ' . $patient->lastname }}</option>
@endforeach
                </select>
            </div>
            <div class="d-flex">
                <a href="{{ route('admin.doctors.patients', $doctor->id) }}"><button type="button" class="btn btn-dark">&larr; Go back</button></a>
                <button type="submit" class="btn btn-primary ml-auto">Assign &rarr;</button>
            </div>
        </form>
    </div>
</section>
@endsection