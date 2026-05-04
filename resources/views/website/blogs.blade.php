@extends('website.layout.structure')

@section('content')
<div class="container-fluid page-header mb-5 py-5" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('website/img/image1.png') }}'); background-size: cover;">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-3 font-dancing-script">Our Blogs</h1>
        <p class="text-white fs-5">Stories, Tips, and Behind the Scenes</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        @isset($blog_arr)
            @forelse($blog_arr as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="{{ asset('admin/images/blogs/' . $blog->image) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="small text-muted mb-2">{{ date('M d, Y', strtotime($blog->created_at)) }}</div>
                        <h5 class="card-title fw-bold mb-3">{{ $blog->title }}</h5>
                        <p class="card-text text-muted small">{{ substr(strip_tags($blog->content), 0, 120) }}...</p>
                        <a href="{{ url('blog-details?id=' . $blog->blog_id) }}" class="btn btn-outline-primary rounded-pill px-4">Read More</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No blog posts available at the moment.</p>
            </div>
            @endforelse
        @else
            <div class="col-12 text-center py-5">
                <p class="text-muted">No blog posts available at the moment.</p>
            </div>
        @endisset
    </div>
</div>
@endsection
