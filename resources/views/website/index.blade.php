@extends('website.layout.structure')

@section('content')
<style>
    .camera{
        width:100%;
        height:500px;
        border-radius:10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom:20px;
    }
</style>

<!-- Spinner Start -->
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Hero Start -->
<div class="container-fluid p-0 hero-header bg-light mb-5">
    <div class="container p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 hero-header-text py-5">
                <div class="py-5 px-3 ps-lg-0">
                    <h1 class="font-dancing-script text-primary animated slideInLeft">Photography</h1>
                    <h1 class="display-1 mb-4 animated slideInLeft">By Monali</h1>
                    <div class="row g-4 animated slideInLeft">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="btn-square btn btn-primary flex-shrink-0">
                                    <i class="fa fa-phone text-dark"></i>
                                </div>
                                <div class="px-3">
                                    <h5 class="text-primary mb-0">Call Us</h5>
                                    <p class="fs-5 text-dark mb-0">6352710112</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="btn-square btn btn-primary flex-shrink-0">
                                    <i class="fa fa-envelope text-dark"></i>
                                </div>
                                <div class="px-3">
                                    <h5 class="text-primary mb-0">Mail Us</h5>
                                    <p class="fs-5 text-dark mb-0">Photography</p>
                                     <p class="fs-5 text-dark mb-0">bymonali@gmail.com</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="owl-carousel header-carousel animated fadeIn">
                    <img class="img-fluid" src="{{ asset('website/img/studio.png') }}" alt="">
              
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.2s">
                <img class="camera" src="{{ asset('website/img/camera.png') }}">
                <div class="d-flex align-items-center bg-light">
                    <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                        <i class="fa fa-phone fa-2x text-dark"></i>
                    </div>
                    <div class="px-3">
                        <h3>+6352710112</h3>
                        <span>Call us direct 24/7 for get a free consultation</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="font-dancing-script text-primary">About Us</h1>
                <h1 class="mb-5">Why People Choose Us!</h1>
                <p class="mb-4">Like any other parent, you would want your newborn to be handled by care. Making photographs look good might seem easy but that might not be the truth. Newborns being delicate need some extra care every second.</p>
                <div class="row g-3 mb-5">
                    <div class="col-sm-6">
                        <div class="bg-light text-center p-4">
                            <i class="fas fa-calendar-alt fa-4x text-primary"></i>
                            <h1 class="display-5" data-toggle="counter-up">07</h1>
                            <p class="text-dark text-uppercase mb-0">Years experience</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bg-light text-center p-4">
                            <i class="fas fa-users fa-4x text-primary"></i>
                            <h1 class="display-5" data-toggle="counter-up">999</h1>
                            <p class="text-dark text-uppercase mb-0">Happy Customers</p>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary text-uppercase px-5 py-3" href="">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

 <style>
/* ===== Gallery Styling ===== */
.gallery-item{
    position: relative;
    overflow: hidden;
    border-radius: 22px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    height:100%;
}
.gallery-item img{
    width:100%;
    height:100%;
    object-fit:cover;
    border-radius:22px;
    transition:0.4s;
}
.gallery-item:hover img{
    transform:scale(1.08);
}
.gallery-icon{
    position:absolute;
    inset:0;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(0,0,0,0.35);
    opacity:0;
    transition:0.4s;
}
.gallery-item:hover .gallery-icon{
    opacity:1;
}
.gallery-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(231, 184, 148, 0.9);
    color: #000;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    z-index: 2;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* ===== Overlay ===== */
#galleryOverlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.9);
    display:none;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    z-index:9999;
}
.overlay-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    color: #fff;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    font-size: 24px;
    transition: 0.3s;
    display: flex;
    align-items:center;
    justify-content: center;
}
.overlay-nav:hover { background: #E7B894; color: #000; border-color: #E7B894; }
.overlay-prev { left: 40px; }
.overlay-next { right: 40px; }

#galleryOverlay img{
    max-width:85%;
    max-height:80%;
    object-fit: contain;
    border-radius:15px;
    box-shadow:0 15px 50px rgba(0,0,0,0.5);
}
#catalogueBtn{
    margin-top:20px;
    padding:12px 40px;
    font-size:16px;
}
.closeOverlay{
    position:absolute;
    top:25px;
    right:35px;
    font-size:40px;
    color:#fff;
    cursor:pointer;
}

</style>

<!-- ================= GALLERY SECTION ================= -->
<div class="container-fluid gallery py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="font-dancing-script text-primary">Gallery</h1>
            <h1>Explore Our Gallery</h1>
        </div>

        <div class="owl-carousel gallery-carousel">
        @isset($gallery_arr)
            @foreach ($gallery_arr as $data)
                @php 
                    $decoded = json_decode($data->image, true); 
                    if(is_array($decoded)) {
                        $images = $decoded;
                    } else {
                        // Fallback for old single image data
                        $images = [$data->image];
                    }
                    if(empty($images) || !$images[0]) continue;
                    $first_img = $images[0];
                @endphp
                <div class="gallery-item-wrapper p-2">
                    <div class="gallery-item">
                        <img src="{{ asset('upload/gallery/' . $first_img) }}"
                             alt="Gallery Session">
                        
                        @if(count($images) > 1)
                        <div class="gallery-badge">
                            <i class="bi bi-images me-1"></i> {{ count($images) }} Photos
                        </div>
                        @endif

                        <div class="gallery-icon">
                            <a href="javascript:void(0)"
                               class="btn btn-primary btn-lg-square open-gallery"
                               data-images='{{ json_encode(array_map(function($img){ return asset("upload/gallery/".$img); }, $images)) }}'
                               data-cat="{{ $data->catalogue_id }}">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
        </div>

    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $(".gallery-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 15,
        loop: true,
        dots: false,
        nav: true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });
});
</script>
@endpush


<!-- ================= IMAGE OVERLAY ================= -->
<div id="galleryOverlay">
    <span class="closeOverlay">&times;</span>
    <button class="overlay-nav overlay-prev" onclick="changeOverlayImage(-1)"><i class="bi bi-chevron-left"></i></button>
    <img id="overlayImg" src="">
    <button class="overlay-nav overlay-next" onclick="changeOverlayImage(1)"><i class="bi bi-chevron-right"></i></button>
    
    <div class="mt-3 text-white small" id="imageCounter">Image 1 of 5</div>
    
    <a id="catalogueBtn" href="#" class="btn btn-primary mt-3">
        View Catalogue
    </a>
</div>

@push('scripts')
<script>
let currentGalleryImages = [];
let currentIndex = 0;

document.querySelectorAll('.open-gallery').forEach(btn => {
    btn.addEventListener('click', function () {
        currentGalleryImages = JSON.parse(this.getAttribute('data-images'));
        let catalogueId = this.getAttribute('data-cat');
        currentIndex = 0;
        
        updateOverlay();
        document.getElementById('catalogueBtn').href = 'gallery?cat_id=' + catalogueId;
        document.getElementById('galleryOverlay').style.display = 'flex';
        
        // Show/hide nav based on count
        let navs = document.querySelectorAll('.overlay-nav');
        if(currentGalleryImages.length <= 1) {
            navs.forEach(n => n.style.display = 'none');
            document.getElementById('imageCounter').style.display = 'none';
        } else {
            navs.forEach(n => n.style.display = 'block');
            document.getElementById('imageCounter').style.display = 'block';
        }
    });
});

function updateOverlay() {
    document.getElementById('overlayImg').src = currentGalleryImages[currentIndex];
    document.getElementById('imageCounter').innerText = `Image ${currentIndex + 1} of ${currentGalleryImages.length}`;
}

function changeOverlayImage(dir) {
    currentIndex += dir;
    if(currentIndex < 0) currentIndex = currentGalleryImages.length - 1;
    if(currentIndex >= currentGalleryImages.length) currentIndex = 0;
    updateOverlay();
}

document.querySelector('.closeOverlay').addEventListener('click', function () {
    document.getElementById('galleryOverlay').style.display = 'none';
});
</script>
@endpush


@endsection