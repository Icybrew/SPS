@extends('layouts.main')

@section('content')
<section class="container my-5">
    <div class="my-5">
        <h1 class="text-center">Create new doctor</h1>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 mx-auto">
@component('components.errors')
@endcomponent
        <form action="{{ route('admin.doctors.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="inputFirstName" name="firstname" value="{{ old('firstname') ? old('firstname') : NULL }}" placeholder="Firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last name</label>
                <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="inputLastName" name="lastname" value="{{ old('lastname') ? old('lastname') : NULL }}" placeholder="Lastname" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" value="{{ old('email') ? old('email') : NULL }}" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="specialization">Specialization</label>
                <select class="form-control @error('specialization') is-invalid @enderror" id="selectSpecialization" name="specialization" required>
                    <option selected disabled hidden="">Specialization</option>
@foreach($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
@endforeach
                    <option value="">Other</option>
                </select>
                <input type="text" class="form-control mt-2 d-none @error('specialization') is-invalid @enderror" id="inputSpecialization" name="customSpecialization" value="{{ old('specialization') ? old('specialization') : NULL }}" placeholder="Specialization">
            </div>
            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="inputSpecialization" name="birthday" value="{{ old('birthday') ? old('birthday') : NULL }}" max="{{ date('Y-m-d') }}" placeholder="Birthday">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Password confirmation" required>
            </div>
            <div class="d-flex">
                <a href="{{ route('admin.doctors.index') }}"><button type="button" class="btn btn-dark">&larr; Go back</button></a>
                <button type="submit" class="btn btn-primary ml-auto">Create &rarr;</button>
            </div>
        </form>
    </div>
</section>
@endsection