@extends('website.layout.structure')

@section('content')
<div class="container-fluid page-header mb-5 py-5" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('website/img/image1.png') }}'); background-size: cover;">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-3 font-dancing-script">Your Private Gallery</h1>
        <p class="text-white fs-5">Secure access to your session memories</p>
    </div>
</div>

<div class="container pb-5">
    <div class="mb-5 p-4 bg-light rounded-4 border">
        <h5 class="fw-bold mb-3"><i class="bi bi-shield-lock me-2"></i> Client Access Policy</h5>
        <ul class="small text-muted mb-0">
            <li>Only you can view your private albums while logged in.</li>
            <li>You can mark photos for selection for final editing/printing.</li>
            <li>Download links are valid for 3 months from the date of upload.</li>
        </ul>
    </div>

    <div class="row g-4">
        @isset($album_arr)
            @forelse($album_arr as $album)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="{{ asset('admin/images/albums/' . $album->thumbnail) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3">{{ $album->title }}</h5>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="small badge bg-secondary">{{ $album->event_date }}</span>
                        </div>
                        <a href="{{ url('view-album?id=' . $album->album_id) }}" class="btn btn-primary rounded-pill w-100 py-2">View Your Gallery</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-images text-muted display-1"></i>
                <h3 class="mt-4">No Private Albums Found</h3>
                <p class="text-muted">Your session photos aren't uploaded yet or your album is inactive.</p>
            </div>
            @endforelse
        @else
            <div class="col-12 text-center py-5">
                <i class="bi bi-images text-muted display-1"></i>
                <h3 class="mt-4">No Private Albums Found</h3>
                <p class="text-muted">Your session photos aren't uploaded yet or your album is inactive.</p>
            </div>
        @endisset
    </div>
</div>
@endsection
