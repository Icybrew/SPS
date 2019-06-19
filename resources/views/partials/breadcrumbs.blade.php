@if (count($breadcrumbs))
                <h2>{{ array_last(end($breadcrumbs))->title }}</h2>
                <div class="page_link">
@foreach ($breadcrumbs as $breadcrumb)
@if ($breadcrumb->url && !$loop->last)
                    <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
@else
                    <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
@endif
@endforeach
                </div>
@endif