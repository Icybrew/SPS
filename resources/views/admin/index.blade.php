@extends('layouts.main')

@section('content')
<section class="my-5">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.doctors.index') }}">Doctors</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.patients.index') }}">Patients</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.pharmacists.index') }}">pharmacists</a>
        </li>
    </ul>
</section>
@endsection