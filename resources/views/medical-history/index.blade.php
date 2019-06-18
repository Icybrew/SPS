@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="container mx-auto">
        <div class="my-3">
            <h1 class="text-center">Your medical history</h1>
        </div>
@if(!empty($medicalHistory) && count($medicalHistory) > 0)
        <ul class="list-group col-xl-6 col-lg-7 col-md-10 col-sm-12 my-auto mx-auto">
@foreach($medicalHistory as $entry)
            <li class="list-group-item my-1">
                <div>
                    Disease code: {{ $entry->disease_code }}
                </div>
                <div>
                    Visit date: {{ $entry->visited_at }}
                </div>
                <div>
                    Doctor: {{ $entry->doctor->firstname . ' ' . $entry->doctor->lastname }}
                </div>
                <div class="text-right">
                    <a href="{{ route('medical-history.show', $entry->id) }}"><button type="button" class="btn btn-primary">See details</button></a>
                </div>
            </li>
@endforeach
        </ul>
        <div class="pagination justify-content-center my-3">
            {{ $medicalHistory->links() }}
        </div>
@else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">Your medical history is empty</h3>
        </div>
@endif
    </div>
</section>
@endsection