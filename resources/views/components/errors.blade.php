@if($errors->any())
@foreach($errors->all() as $error)
<div class="col-12 text-center">
    <div class="alert alert-danger col-10 mx-auto" role="alert">{{ $error }}</div>
</div>
@endforeach
@endif