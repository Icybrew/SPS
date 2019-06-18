@extends('layouts.main')

@section('content')
<div>
    <h1 class="text-center py-2">{!! __('profile.title.profile') !!}</h1>
    <div class="col-xl-6 col-lg-8 col-md-10 col-sm-10 mx-auto mb-5 py-2 shadow d-flex flex-column">
        <div class="row border-bottom my-1 py-2">
            <h5 class="my-auto mr-3 col-3">{!! __('profile.username') !!}:</h5>
            <h5 class="my-auto col-8">{{ $user->name }}</h5>
        </div>
        <div class="row border-bottom my-1 py-2">
            <h5 class="my-auto mr-3 col-3">{!! __('profile.email') !!}: </h5>
            <h5 class="my-auto col-8">{{ $user->email }}</h5>
        </div>
        <div class="row my-1 py-2">
            <h5 class="my-auto mr-3 col-3">{!! __('profile.registered') !!}: </h5>
            <h5 class="my-auto col-8">{{ $user->created_at }}</h5>
        </div>
    </div>
</div>
@endsection