@extends('layouts.main')

@section('content')
<div class="container">
    <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 mx-auto">
        <div class="my-5 text-center">
            <h1>Change password</h1>
        </div>
        <div class="mb-5 p-2 shadow d-flex flex-column">
            <form action="{{ route('profile.update-password', $user->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row border-bottom my-1 py-1">
                    <h5 class="my-auto mr-3 col-4">Old password: </h5>
                    <input type="password" class="form-control col-7 my-auto @error('password_old') is-invalid @enderror" name="password_old" placeholder="Old password" required>
@error('password_old')
                    <span class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
@enderror
                </div>
                <div class="row border-bottom my-1 py-1">
                    <h5 class="my-auto mr-3 col-4">New password: </h5>
                    <input type="password" class="form-control col-7 my-auto @error('password_new') is-invalid @enderror" name="password_new" placeholder="New password" required>
@error('password_new')
                    <span class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
@enderror
                </div>
                <div class="row border-bottom my-1 py-1">
                    <h5 class="my-auto mr-3 col-4">New password confirmation: </h5>
                    <input type="password" class="form-control col-7 my-auto @error('password_new') is-invalid @enderror" name="password_new_confirmation" placeholder="New password confirmation" required>
                </div>
                <div class="mt-3 pb-5">
                    <a href="{{ url()->previous() }}"><button type="button" class="btn btn-dark float-left">&larr; Go back</button></a>
                    <button type="submit" class="btn btn-primary float-right">Confirm &rarr;</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection