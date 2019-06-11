@extends('layouts.main')

@section('content')
<section class="my-5">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.doctors.index') }}">Doctors</a>
        </li>
    </ul>
</section>
@endsection