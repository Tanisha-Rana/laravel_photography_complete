@extends('website.layout.structure')

@section('content')
<!-- Catalogues Start -->
<div class="container py-5">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h1 class="font-dancing-script text-primary">Our Collections</h1>
        <h1 class="display-5 mb-4">Explore Our Creative Catalogues</h1>
        <p class="mb-0">Explore our professional photography collections categorized by special moments.</p>
    </div>
    <div class="row g-4">
        @isset($catalogue_arr)
            @forelse($catalogue_arr as $cat)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="catalogue-item shadow-sm rounded overflow-hidden h-100 bg-white border">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('upload/catalogues/' . $cat->image) }}" class="img-fluid w-100" style="height: 300px; object-fit: cover;" alt="{{ $cat->catalogue_name }}">
                        <div class="catalogue-overlay">
                             <a href="{{ url('gallery?catalogue_id=' . $cat->id) }}" class="btn btn-outline-light px-3 py-2 me-2">Gallery</a>
                             @if(request()->get('mode') == 'select')
                                <a href="{{ url('booking?id=' . $cat->id . '&category_id=' . $cat->category_id) }}" class="btn btn-primary px-3 py-2">Select Theme</a>
                             @else
                                <a href="{{ url('booking?catalogue_id=' . $cat->id . '&category_id=' . $cat->category_id) }}" class="btn btn-primary px-3 py-2">Book Now</a>
                             @endif
                        </div>
                    </div>
                    <div class="p-4 text-center">
                        <h4 class="mb-3">{{ $cat->catalogue_name }}</h4>
                        <p class="text-muted mb-0">{{ $cat->description }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-light border shadow-sm">No catalogues available at the moment.</div>
            </div>
            @endforelse
        @else
            <div class="col-12 text-center py-5">
                <div class="alert alert-light border shadow-sm">No catalogues available at the moment.</div>
            </div>
        @endisset
    </div>
</div>
<!-- Catalogues End -->

<style>
.catalogue-item {
    transition: 0.5s;
}
.catalogue-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}
.catalogue-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.4);
    opacity: 0;
    transition: 0.5s;
}
.catalogue-item:hover .catalogue-overlay {
    opacity: 1;
}
</style>
@endsection