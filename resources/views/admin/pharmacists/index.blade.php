@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="container mx-auto">
        <div class="my-3">
            <h1 class="text-center">Pharmacists</h1>
        </div>
@if(!empty($pharmacists) && count($pharmacists) > 0)
        <ul class="list-group col-xl-6 col-lg-7 col-md-10 col-sm-12 my-auto mx-auto">
@foreach($pharmacists as $pharmacist)
            <li class="list-group-item">ID: {{ $pharmacist->id }}, <a href="{{ route('admin.pharmacists.show', $pharmacist->id) }}">{{ $pharmacist->firstname . ' ' . $pharmacist->lastname }}</a> - {{ $pharmacist->email }} </li>
@endforeach
        </ul>
        <div class="pagination justify-content-center my-3">
            {{ $pharmacists->links() }}
        </div>
@else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">There are 0 pharmacists</h3>
        </div>
@endif
        <div class="text-center my-3">
            <a href="{{ route('admin.pharmacists.create') }}"><button type="button" class="btn btn-lg btn-primary">Create new pharmacist</button></a>
        </div>
    </div>
</section>
@endsection