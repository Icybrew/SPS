@extends('layouts.main')

@section('content')
@component('components.header', ['name' => 'Contact us', 'link' => 'contacts.index'])
@endcomponent
<section class="mx-auto my-5">
    <div class="container">
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d26087.56689826272!2d25.27261940938848!3d54.694897161622265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1slt!2slt!4v1560252363256!5m2!1slt!2slt" width="100%" height="420" allowfullscreen></iframe>
        </div>
        <div class="row pt-5">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 my-2">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="fas fa-home"></i>
                        <h6>Vilnius, Lithuania</h6>
                        <p>Our address</p>
                    </div>
                    <div class="info_item">
                        <i class="fas fa-phone-alt"></i>
                        <h6>
                            <a href="#">+370 123 45678</a>
                        </h6>
                        <p>Mon to Fri 9am to 6 pm</p>
                    </div>
                    <div class="info_item">
                        <i class="fas fa-envelope"></i>
                        <h6>
                            <a href="#">info@sps.lt</a>
                        </h6>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 my-2">
                <form class="row contact_form" action="#" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Enter email address">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Enter Subject">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="1" placeholder="Enter Message"></textarea>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-right">
                        <button type="submit" value="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
