@extends('layouts.main')

@section('content')
<!--================ Home Banner Area =================-->
<header>
    <section class="home-banner-wrapper">
        <div class="banner-inner-wrapper d-flex align-items-center">
            <div class="container">
                <div class="banner-content row">
                    <div class="col-lg-12">
                        <h1>We Care for Your Health Every Moment</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a href="#"><button class="btn btn-primary">Get started</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
<!--================ End Home Banner Area =================-->

<!--================ Procedure Category Area =================-->
<section class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-10 col-sm-10 my-5 mx-auto text-center text-dark">
                <h1>Procedure Category</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mx-auto">
                <div class="procedure">
                    <img src="img/p1.jpg" alt="Procedure" class="img-fluid">
                    <div class="procedure-details d-flex">
                        <div class="procedure-text m-auto">
                            <a href="#">
                                <h5>Emergency Treatment</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mx-auto">
                <div class="procedure">
                    <img src="img/p2.jpg" alt="Procedure" class="img-fluid">
                    <div class="procedure-details d-flex">
                        <div class="procedure-text m-auto">
                            <a href="#">
                                <h5>Emergency Treatment</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mx-auto">
                <div class="procedure">
                    <img src="img/p3.jpg" alt="Procedure" class="img-fluid">
                    <div class="procedure-details d-flex">
                        <div class="procedure-text m-auto">
                            <a href="#">
                                <h5>Emergency Treatment</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Procedure Category Area =================-->

<!--================ Offered Services Area =================-->
<section class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-10 col-sm-10 my-5 mx-auto text-center text-dark">
                <h1>Our Offered Services</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service text-center">
                    <i class="fas fa-rocket"></i>
                    <a href="#">
                        <h4>24/7 Emergency</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service text-center">
                    <i class="fas fa-heartbeat "></i>
                    <a href="#">
                        <h4>Expert Consultation</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service text-center">
                    <i class="fas fa-bug"></i>
                    <a href="#">
                        <h4>Intensive Care</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-5">
                <div class="single-service text-center">
                    <i class="fas fa-users "></i>
                    <a href="#">
                        <h4>Family Planning</h4>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Offered Services Area =================-->
@endsection
