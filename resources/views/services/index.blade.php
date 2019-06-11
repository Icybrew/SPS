@extends('layouts.main')

@section('content')
@component('components.header', ['name' => 'Services', 'link' => 'services.index'])
@endcomponent
<section class="mx-auto">
    <div class="container">
        <div class="row text-center mt-5">
            <div class="col-lg-6 mx-auto my-5">
                <h1 class="my-2 text-dark">Our Offered Services</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service">
                    <i class="fas fa-rocket"></i>
                    <a href="#">
                        <h4>24/7 Emergency</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service">
                    <i class="fas fa-heartbeat"></i>
                    <a href="#">
                        <h4>Expert Consultation</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service">
                    <i class="fas fa-bug"></i>
                    <a href="#">
                        <h4>Intensive Care</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service">
                    <i class="fas fa-users"></i>
                    <a href="#">
                        <h4>Family Planning</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service">
                    <i class="fas fa-rocket"></i>
                    <a href="#">
                        <h4>24/7 Emergency</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service">
                    <i class="fas fa-heartbeat"></i>
                    <a href="#">
                        <h4>Expert Consultation</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service">
                    <i class="fas fa-bug"></i>
                    <a href="#">
                        <h4>Intensive Care</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service">
                    <i class="fas fa-users"></i>
                    <a href="#">
                        <h4>Family Planning</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
