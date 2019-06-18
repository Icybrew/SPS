@extends('layouts.main')

@section('content')
<section class="my-5">
    <div class="container mx-auto">
        <div class="my-3">
            <h1 class="text-center">Your prescriptions</h1>
        </div>
@if(!empty($prescriptions) && count($prescriptions) > 0)
        <ul class="list-group col-xl-6 col-lg-7 col-md-10 col-sm-12 my-auto mx-auto">
@foreach($prescriptions as $prescription)
            <li class="list-group-item my-1 {{ ($prescription->expires_at !== NULL && date('Y-m-d') > $prescription->expires_at) ? 'list-group-item-danger' : '' }}">
                <div>
                    Substance: {{ $prescription->medicalSubstance->name }}
                </div>
                <div>
                    Expires: {{ ($prescription->expires_at !== NULL) ? $prescription->expires_at->format('Y-m-d') : 'Never'  }}
                </div>
                <div class="text-right">
                    <a href="{{ route('prescriptions.show', $prescription->id) }}"><button type="button" class="btn btn-primary">See details</button></a>
                </div>
            </li>
@endforeach
        </ul>
        <div class="pagination justify-content-center my-3">
            {{ $prescriptions->links() }}
        </div>
@else
        <div class="alert alert-info" role="alert">
            <h3 class="text-center my-auto">You have no prescriptions</h3>
        </div>
@endif
    </div>
</section>
@endsection