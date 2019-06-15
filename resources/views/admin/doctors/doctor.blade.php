@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="card col-3 mx-auto">
@component('components.success')
@endcomponent
        <div class="card-body">
            <h5 class="card-title">{{ $doctor->firstname . ' ' . $doctor->lastname }}</h5>
            <p class="card-text">Specialization - {{ !empty($doctor->extraInfoDoctor->specialization->name) ? $doctor->extraInfoDoctor->specialization->name : 'Not specified' }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Email: {{ $doctor->email }}</li>
            <li class="list-group-item">Birthday: {{ !empty($doctor->birthday) ? $doctor->birthday : 'Not specified' }}</li>
            <li class="list-group-item">Registered at: {{ $doctor->created_at }}</li>
            <li class="list-group-item">Updated at: {{ $doctor->updated_at }}</li>
        </ul>
        <div class="card-body d-flex">
            <a href="{{ route('admin.doctors.index') }}" class="mr-auto"><button type="button" class="btn btn-dark">&larr; Go back</button></a>
            <div>
                <a href="{{ route('admin.doctors.patients', $doctor->id) }}" class="card-link"><button type="button" class="btn btn-primary">Patients</button></a>
                <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="card-link"><button type="button" class="btn btn-primary">Edit</button></a>
                <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection