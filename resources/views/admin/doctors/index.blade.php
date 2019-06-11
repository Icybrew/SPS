@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="container mx-auto">
        <div class="my-3">
            <h1 class="text-center">Doctors</h1>
        </div>
        @if(!empty($doctors) && count($doctors) > 0)
        <ul class="list-group col-xl-6 col-lg-7 col-md-10 col-sm-12 my-auto mx-auto">
            @foreach($doctors as $doctor)
            <li class="list-group-item">ID: {{ $doctor->id }}, <a href="{{ route('admin.doctors.show', $doctor->id) }}">{{ $doctor->name }}</a> - {{ $doctor->email }} </li>
            @endforeach
        </ul>
        @else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">There are 0 doctors</h3>
        </div>
        @endif
        <div class="text-center my-3">
            <a href="{{ route('admin.doctors.create') }}"><button type="button" class="btn btn-lg btn-primary">Create new doctor</button></a>
        </div>
    </div>
</section>
@endsection