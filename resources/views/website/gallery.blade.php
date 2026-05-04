@extends('website.layout.structure')

@section('content')
<!-- Horizontal Scroll Gallery Start -->
<div class="container-fluid gallery py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="font-dancing-script text-primary">Our Masterpieces</h1>
            <h1 class="display-5 mb-4">Explore Our Moments</h1>
            <p>Scroll horizontally to view more images</p>
        </div>

        <div class="scroll-wrapper">
            <div class="scroll-container" id="galleryScroll">
                @isset($gallery_arr)
                    @forelse($gallery_arr as $data)
                        @php 
                            $decoded = json_decode($data->image, true); 
                            $images = is_array($decoded) ? $decoded : [$data->image];
                        @endphp
                        @if(!empty($images) && $images[0])

                            @foreach($images as $img)
                            <div class="scroll-item">
                                <div class="gallery-card">
                                    <img src="{{ url('upload/gallery/' . $img) }}" alt="Gallery Image">
                                </div>
                            </div>
                            @endforeach
                        @endif
                    @empty

                    <div class="w-100 text-center py-5">
                        <div class="alert alert-light border shadow-sm">No images found in this gallery.</div>
                    </div>
                    @endforelse
                @else
                    <div class="w-100 text-center py-5">
                        <div class="alert alert-light border shadow-sm">No images found in this gallery.</div>
                    </div>
                @endisset
            </div>
            
            <!-- Custom Navigation Buttons -->
            <button class="nav-btn prev" onclick="scrollGallery(-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="nav-btn next" onclick="scrollGallery(1)"><i class="bi bi-chevron-right"></i></button>
        </div>
    </div>
</div>
<!-- Horizontal Scroll Gallery End -->

<style>
/* Scroll Area Styling */
.scroll-wrapper {
    position: relative;
    padding: 20px 0;
}

.scroll-container {
    display: flex;
    overflow-x: auto;
    scroll-behavior: smooth;
    gap: 20px;
    padding: 10px;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin; /* Firefox */
    scrollbar-color: var(--bs-primary) #f1f1f1;
}

/* Chrome, Edge, and Safari scrollbar */
.scroll-container::-webkit-scrollbar {
    height: 8px;
}
.scroll-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}
.scroll-container::-webkit-scrollbar-thumb {
    background: var(--bs-primary);
    border-radius: 10px;
}

.scroll-item {
    flex: 0 0 calc(20% - 16px); /* Show exactly 5 items on large screens (100%/5 = 20%) */
    min-width: 250px;
}

@media (max-width: 1200px) { .scroll-item { flex: 0 0 calc(25% - 15px); } }
@media (max-width: 992px) { .scroll-item { flex: 0 0 calc(33.33% - 14px); } }
@media (max-width: 768px) { .scroll-item { flex: 0 0 calc(50% - 10px); } }
@media (max-width: 576px) { .scroll-item { flex: 0 0 100%; } }

.gallery-card {
    position: relative;
    height: 400px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.gallery-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gallery-info {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 20px;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: #fff;
    opacity: 0;
    transition: 0.3s;
}

.gallery-card:hover .gallery-info {
    opacity: 1;
}

/* Nav Buttons */
.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 45px;
    height: 45px;
    background: var(--bs-primary);
    border: none;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 5;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.nav-btn.prev { left: -22px; }
.nav-btn.next { right: -22px; }

@media (max-width: 1400px) {
    .nav-btn.prev { left: 5px; }
    .nav-btn.next { right: 5px; }
}

.nav-btn:hover {
    background: #000;
}
</style>

<script>
function scrollGallery(direction) {
    const container = document.getElementById('galleryScroll');
    const scrollAmount = container.offsetWidth * 0.8; // Scroll 80% of view
    container.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}
</script>
@endsection
