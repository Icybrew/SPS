<section class="banner-wrapper">
    <div class="banner-inner-wrapper d-flex align-items-center">
        <div class="container">
            <div class="banner-content text-left">
                <h2>{{ $name }}</h2>
                <div class="page_link">
                    <a href="{{ route('home.index') }}">Home</a>
                    <a href="{{ route($link) }}">{{ $name }}</a>
                </div>
            </div>
        </div>
    </div>
</section>