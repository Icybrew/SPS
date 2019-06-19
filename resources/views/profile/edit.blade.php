@extends('layouts.main')

@section('content')
@component('components.header')
{{ Breadcrumbs::render('profile.edit', $user) }}
@endcomponent
<div class="container my-5">
    <div class="col-xl-6 col-lg-10 col-md-10 col-sm-12 mx-auto">
        <div class="my-5 text-center">
            <h1>Edit profile</h1>
        </div>
        <div class="mb-5 p-2 shadow d-flex flex-column">
            <form action="{{ route('profile.update', $user->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row border-bottom my-1 py-1">
                    <h5 class="my-auto mr-3 col-3">Firstname:</h5>
                    <input type="text" class="form-control col-8 my-auto @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') ? old('firstname') : $user->firstname }}" placeholder="Firstname">
@error('firstname')
                    <span class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
@enderror
                </div>
                <div class="row border-bottom my-1 py-1">
                    <h5 class="my-auto mr-3 col-3">Lastname:</h5>
                    <input type="text" class="form-control col-8 my-auto @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') ? old('lastname') : $user->lastname }}" placeholder="Lastname">
@error('lastname')
                    <span class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
@enderror
                </div>
                <div class="row border-bottom my-1 py-2">
                    <h5 class="my-auto mr-3 col-3">Email: </h5>
                    <h5 class="my-auto text-muted col-8">{{ $user->email }}</h5>
                </div>
                <div class="row border-bottom my-1 py-1">
                    <h5 class="my-auto mr-3 col-3">Birthday:</h5>
                    <input type="date" class="form-control col-8 my-auto @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') ? old('birthday') : $user->birthday }}" max="{{ date('Y-m-d') }}" placeholder="Birthday">
@error('birthday')
                    <span class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
@enderror
                </div>
                <div class="row border-bottom my-1 py-1">
                    <h5 class="my-auto mr-3 col-3">Password: </h5>
                    <input type="password" class="form-control col-8 my-auto @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
@error('password')
                    <span class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
@enderror
                </div>
                <div class="mt-3 pb-5">
                    <a href="{{ route('profile.index') }}"><button type="button" class="btn btn-dark float-left">&larr; Profile</button></a>
                    <button type="submit" class="btn btn-primary float-right">Confirm &rarr;</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection