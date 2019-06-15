@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="card col-3 mx-auto">
@component('components.success')
@endcomponent
        <div class="card-body">
            <h5 class="card-title">{{ $pharmacist->firstname . ' ' . $pharmacist->lastname }}</h5>
            <p class="card-text">Workplace - {{ !empty($pharmacist->extraInfoPharmacist->workplace) ? $pharmacist->extraInfoPharmacist->workplace : 'Not specified' }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Email: {{ $pharmacist->email }}</li>
            <li class="list-group-item">Birthday: {{ !empty($pharmacist->birthday) ? $pharmacist->birthday : 'Not specified' }}</li>
            <li class="list-group-item">Registered at: {{ $pharmacist->created_at }}</li>
            <li class="list-group-item">Updated at: {{ $pharmacist->updated_at }}</li>
        </ul>
        <div class="card-body d-flex">
            <a href="{{ route('admin.pharmacists.index') }}" class="mr-auto"><button type="button" class="btn btn-dark">&larr; Go back</button></a>
            <div>
                <a href="{{ route('admin.pharmacists.edit', $pharmacist->id) }}" class="card-link"><button type="button" class="btn btn-primary">Edit</button></a>
                <form action="{{ route('admin.pharmacists.destroy', $pharmacist->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection