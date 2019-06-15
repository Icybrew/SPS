@extends('layouts.main')

@section('content')
<section class="container my-5">
    <div class="my-5">
        <h1 class="text-center">{{ $patient->firstname . ' ' . $patient->lastname }}</h1>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 mx-auto">
@component('components.errors')
@endcomponent
        <form action="{{ route('admin.patients.update', $patient->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name">Firstname</label>
                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') ? old('firstname') : $patient->firstname }}" placeholder="Firstname" required>
            </div>
            <div class="form-group">
                <label for="name">Lastname</label>
                <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') ? old('lastname') : $patient->lastname }}" placeholder="Lastname" required>
            </div>
            <div class="form-group">
                <label for="ssn">Social security number</label>
                <input type="number" class="form-control @error('ssn') is-invalid @enderror" id="inputSSN" name="ssn" value="{{ old('ssn') ? old('ssn') : (!empty($patient->extraInfoPatient->ssn) ? $patient->extraInfoPatient->ssn : NULL) }}" min="10000000000" max="99999999999" placeholder="SSN" required>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="inputSpecialization" name="birthday" value="{{ old('birthday') ? old('birthday') : $patient->birthday }}" max="{{ date('Y-m-d') }}" placeholder="Birthday" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                <small>Leave password blank if dont want to change</small>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation">
            </div>
            <div class="d-flex">
                <a href="{{ route('admin.patients.show', $patient->id) }}"><button type="button" class="btn btn-dark">&larr; Go back</button></a>
                <button type="submit" class="btn btn-primary ml-auto">Update &rarr;</button>
            </div>
        </form>
    </div>
</section>
@endsection