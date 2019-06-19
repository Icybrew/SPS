@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('patients.prescriptions.create', $patient) }}
@endcomponent
<section class="container my-5">
    <div class="my-5">
        <h1 class="text-center">New prescription</h1>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 mx-auto">
        @component('components.errors')
        @endcomponent
        <form action="{{ route('patients.prescriptions.store', $patient->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="inputExpiration">Expiration date</label>
                <input type="date" class="form-control @error('expiration') is-invalid @enderror" id="inputExpiration" name="expiration" value="{{ old('expiration') ? old('expiration') : NULL }}" max="{{ date('Y-m-d') }}" placeholder="Expiration date">
                <small class="form-text text-muted ml-1">Leave blank to never expire</small>
            </div>
            <div class="form-group">
                <label for="inputMedicine">Medicine</label>
                <select class="form-control @error('medicine') is-invalid @enderror" id="selectMedicine" name="medicine" required>
                    <option{{ old('medicine') ? NULL : ' selected' }} disabled hidden>Select medicine</option>
@foreach($substances as $substance)
                    <option value="{{ $substance->id }}"{{ old('medicine') == $substance->id ? ' selected' : NULL }}>{{ $substance->name }}</option>
@endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputAmount">Drug amount in one dose</label>
                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="inputAmount" name="amount" value="{{ old('amount') ? old('amount') : NULL }}" min="1" step="0.01" placeholder="Amount" required>
            </div>
            <div class="form-group">
                <label for="inputUnit">Measurement unit</label>
                <select class="form-control @error('unit') is-invalid @enderror" id="selectUnit" name="unit" required>
                    <option{{ old('unit') ? NULL : ' selected' }} disabled hidden>Select unit</option>
@foreach($measurementUnits as $unit)
                    <option value="{{ $unit->id }}"{{ old('unit') == $unit->id ? ' selected' : NULL }}>{{ $unit->unit }}</option>
@endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputDescription">Usage description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="inputDescription" name="description" placeholder="Description" required>{{ old('description') ? old('description') : NULL }}</textarea>
            </div>
            <div class="mt-3 d-flex">
                <a href="{{ route('patients.prescriptions.index', $patient->id) }}"><button type="button" class="btn btn-dark">&larr; All prescriptions</button></a>
                <button type="submit" class="btn btn-primary ml-auto">Create &rarr;</button>
            </div>
        </form>
    </div>
</section>
@endsection