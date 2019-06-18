@extends('layouts.main')

@section('content')
<div class="container">
@component('components.errors')
@endcomponent
@component('components.success')
@endcomponent
    <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 mx-auto">
        <div class="my-5 text-center">
            <h1>Your profile</h1>
        </div>
        <div class="shadow d-flex flex-column">
            <div class="row border-bottom my-1 py-2">
                <h5 class="my-auto text-right col-4">Name:</h5>
                <h5 class="my-auto col-8">{{ $user->firstname . ' ' . $user->lastname }}</h5>
            </div>

            <div class="row border-bottom my-1 py-2">
                <h5 class="my-auto text-right col-4">Email: </h5>
                <h5 class="my-auto col-8">{{ $user->email }}</h5>
            </div>
            <div class="row border-bottom my-1 py-2">
                <h5 class="my-auto text-right col-4">Birthday: </h5>
                <h5 class="my-auto col-8">{{ $user->birthday }}</h5>
            </div>
            <div class="row my-1 pt-2">
                <h5 class="my-auto text-right col-4">Registered at: </h5>
                <h5 class="my-auto col-8">{{ $user->created_at }}</h5>
            </div>  
@can('update', $user)
            <div class="mx-auto my-3">
                <a href="{{ route('profile.edit', $user->id) }}" class="mx-auto"><button type="button" class="btn btn-primary">Edit profile</button></a>
                <a href="{{ route('profile.edit-password', $user->id) }}" class="mx-auto"><button type="button" class="btn btn-primary">Change password</button></a>
            </div>
@endcan
        </div>
    </div>
</div>
@endsection