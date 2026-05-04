@extends('website.layout.structure')

@section('content')
<style>
    .package-section { padding: 80px 0; background: #fff; }
    .category-tab-btn {
        padding: 12px 30px;
        border-radius: 50px;
        border: 2px solid #E7B894;
        background: transparent;
        color: #000;
        font-weight: 600;
        margin: 5px;
        transition: 0.3s;
    }
    .category-tab-btn.active, .category-tab-btn:hover {
        background: #E7B894;
        color: #fff;
    }
    .price-card {
        border-radius: 20px;
        border: 1px solid #f0f0f0;
        padding: 40px;
        transition: 0.4s;
        height: 100%;
        background: #fff;
        display: flex;
        flex-direction: column;
    }
    .price-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        border-color: #E7B894;
    }
    .price-card h3 { color: #E7B894; font-weight: 700; margin-bottom: 20px; }
    .price-card .price { font-size: 34px; font-weight: 800; margin-bottom: 25px; }
    .price-card .price span { font-size: 16px; font-weight: 400; color: #777; }
    .price-card ul { list-style: none; padding: 0; margin-bottom: 30px; flex-grow: 1; }
    .price-card ul li { margin-bottom: 12px; color: #555; position: relative; padding-left: 25px; }
    .price-card ul li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #E7B894;
        font-weight: bold;
    }
    .btn-book {
        background: #E7B894;
        color: #fff;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        border: none;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-book:hover {
        background: #d4a37f;
        color: #fff;
    }
    .cat-section { display: none; }
    .cat-section.active { display: block; }
</style>

<div class="container-fluid page-header mb-5 py-5" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('website/img/image1.png') }}'); background-size: cover;">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-3 font-dancing-script">Pricing Plans</h1>
        <p class="text-white fs-5">Choose the perfect package for your story</p>
    </div>
</div>

<div class="container pb-5">
    <!-- Category Tabs -->
    <div class="text-center mb-5">
        @isset($categories)
            @foreach($categories as $index => $cat)
                <button class="category-tab-btn {{ $index == 0 ? 'active' : '' }}" onclick="showCategory({{ $cat->category_id }}, this)">
                    {{ $cat->category_name }}
                </button>
            @endforeach
        @endisset
    </div>

    <!-- Packages Grid -->
                    <div class="row g-4">
                    @isset($pack_arr)
                        @foreach($pack_arr as $value)
                            <div class="col-lg-4 col-md-6">
                                <div class="price-card">
                                    <h3>{{ $value->package_name }}</h3>
                                    <div class="price">₹{{ number_format($value->price, 0) }} <span>/ Session</span></div>
                                    <ul>
                                        @php
                                            $features = explode("\n", $value->description);
                                        @endphp
                                        @foreach($features as $feature)
                                            @if(trim($feature))
                                                <li>{{ trim($feature) }}</li>
                                            @endif
                                        @endforeach
                                        <li>Max Themes: {{ $value->max_catelogues }}</li>
                                    </ul>
                                    <a href="{{ url('booking?id=' . $value->id) }}" class="btn btn-book text-center">Book This Plan</a>
                                </div>
                            </div>
                        @endforeach
                        
                        @if(count($pack_arr) == 0)
                            <div class="col-12 text-center py-5">
                                <p class="text-muted">No packages available for this category yet.</p>
                            </div>
                        @endif
                    @else
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No packages available for this category yet.</p>
                        </div>
                    @endisset
                </div>
            </div>
       
</div>

<script>
function showCategory(id, btn) {
    document.querySelectorAll('.cat-section').forEach(sec => sec.classList.remove('active'));
    document.getElementById('cat-' + id).classList.add('active');
    document.querySelectorAll('.category-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}
</script>
@endsection
