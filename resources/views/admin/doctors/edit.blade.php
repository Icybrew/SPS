@extends('layouts.main')

@section('content')
<section class="container my-5">
    <div class="my-5">
        <h1 class="text-center">{{ $doctor->name }}</h1>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 mx-auto">
@component('components.errors')
@endcomponent
        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="name" value="{{ old('firstname') ? old('firstname') : $doctor->name }}" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="specialization">Specialization</label>
                <input type="text" class="form-control @error('specialization') is-invalid @enderror" id="specialization" name="specialization" value="{{ old('firstname') ? old('specialization') : $doctor->extraInfoDoctor->specialization }}" placeholder="Specialization" required>
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
                <a href="{{ route('admin.doctors.show', $doctor->id) }}"><button type="button" class="btn btn-dark">&larr; Go back</button></a>
                <button type="submit" class="btn btn-primary ml-auto">Update &rarr;</button>
            </div>
        </form>
    </div>
</section>
@endsection