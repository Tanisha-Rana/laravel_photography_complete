@extends('website.layout.structure')

@section('content')
<div class="container py-5">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h1 class="font-dancing-script text-primary">Experience the Magic</h1>
        <h1 class="display-5 mb-4">Our Photography Categories</h1>
        <p class="mb-0">From the first breath of a newborn to the warmth of family portraits, we capture every milestone with love and perfection.</p>
    </div>
    <div class="row g-5 align-items-center text-center category-row">
        @isset($cate_arr)
            @foreach($cate_arr as $value)
            <div class="col-md-6">
                <div class="category-item wow fadeInUp" data-wow-delay="0.3s">
                    <img src="{{ url('upload/categories/' . $value->category_image) }}" class="img-fluid cate_img" alt="">
                    <h2 class="mt-4">{{ $value->category_name }}</h2>

                    <div class="category-btns">
                        <a href="{{ url('catalogues?id=' . $value->id) }}" class="btn btn-primary btn-sm">View Catalogues</a>
                    </div>
                    <div>
                        <a href="{{ url('packages?id=' . $value->id) }}" class="btn btn-primary btn-sm">View Packages</a>
                    </div>
                </div>
            </div>
            @endforeach
        @endisset
    </div>
</div>

<style>
    /* Category Layout */
.category-item{
    padding: 20px;
}

/* Image */
.cate_img{
    width: 300px;
    height: 300px;
    object-fit: cover;
    border-radius: 50%;
    transition: transform 0.6s ease;
}

/* Hover Image Effect */
.category-item:hover .cate_img{
    transform: scale(1.08);
}

/* Text */
.category-item h2{
    font-weight: 600;
    letter-spacing: 1px;
}

.category-item p{
    max-width: 380px;
    margin: 10px auto 20px;
    color: #777;
    font-size: 15px;
}

/* Buttons */
.category-btns{
    display: flex;
    justify-content: center;
    gap: 12px;
}
</style>

<!-- Testimonial Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center wow fadeIn" data-wow-delay="0.2s">
            <h1 class="font-dancing-script text-primary">Testimonial</h1>
            <h1 class="mb-5">What Clients Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.3s">
            <div class="text-center bg-light p-4">
                <i class="fa fa-quote-left fa-3x mb-3"></i>
                <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat
                    ipsum et lorem et sit.</p>
                <img class="img-fluid mx-auto border p-1 mb-3" src="{{ asset('website/img/testimonial-1.jpg') }}" alt="">
                <h4 class="mb-1">Client Name</h4>
                <span>Profession</span>
            </div>
            <div class="text-center bg-light p-4">
                <i class="fa fa-quote-left fa-3x mb-3"></i>
                <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat
                    ipsum et lorem et sit.</p>
                <img class="img-fluid mx-auto border p-1 mb-3" src="{{ asset('website/img/testimonial-2.jpg') }}" alt="">
                <h4 class="mb-1">Client Name</h4>
                <span>Profession</span>
            </div>
            <div class="text-center bg-light p-4">
                <i class="fa fa-quote-left fa-3x mb-3"></i>
                <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat
                    ipsum et lorem et sit.</p>
                <img class="img-fluid mx-auto border p-1 mb-3" src="{{ asset('website/img/testimonial-3.jpg') }}" alt="">
                <h4 class="mb-1">Client Name</h4>
                <span>Profession</span>
            </div>
            <div class="text-center bg-light p-4">
                <i class="fa fa-quote-left fa-3x mb-3"></i>
                <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat
                    ipsum et lorem et sit.</p>
                <img class="img-fluid mx-auto border p-1 mb-3" src="{{ asset('website/img/testimonial-4.jpg') }}" alt="">
                <h4 class="mb-1">Client Name</h4>
                <span>Profession</span>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
@endsection