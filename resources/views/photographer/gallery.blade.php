@extends('photographer.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">My Gallery</h1>
    <a href="#" class="btn btn-primary rounded-pill px-4">Upload Images</a>
</div>

<div class="row g-4">
    @forelse($gallery_arr ?? [] as $gallery)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <img src="{{ url('upload/gallery/'.$gallery->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body p-3">
                    <h6 class="mb-1 text-dark truncate">{{ $gallery->catalogue_name ?? 'Portfolio' }}</h6>
                    <small class="text-muted d-block mb-3">#{{ $gallery->gallery_id }}</small>
                    <div class="btn-group w-100">
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 text-muted">
            <i class="fa fa-images fa-3x mb-3"></i>
            <p>Your gallery is empty. Start uploading photos now!</p>
        </div>
    @endforelse
</div>
@endsection