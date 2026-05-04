@extends('admin.layout.structure')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-4">Reports & Analytics</h3>

    <div class="row g-4">
        <!-- Package Ranking -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h5 class="fw-bold mb-3">Top Packages</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-muted small">
                                <th>PACKAGE NAME</th>
                                <th class="text-end">BOOKINGS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($pop_pkg)
                                @foreach($pop_pkg as $p)
                                <tr>
                                    <td class="fw-bold text-primary">{{ $p->package_name }}</td>
                                    <td class="text-end"><span class="badge bg-primary rounded-pill px-3">{{ $p->count }}</span></td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Category Breakdown -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h5 class="fw-bold mb-3">Bookings by Category</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-muted small">
                                <th>CATEGORY</th>
                                <th class="text-end">COUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($cat_dist)
                                @foreach($cat_dist as $c)
                                <tr>
                                    <td class="fw-bold text-info">{{ $c->category_name }}</td>
                                    <td class="text-end"><span class="badge bg-info text-dark rounded-pill px-3">{{ $c->count }}</span></td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Revenue Overview -->
        <div class="col-md-12">
            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h5 class="fw-bold mb-3">Monthly Revenue (Last 6 Months)</h5>
                <div class="d-flex justify-content-between align-items-end pt-5" style="height: 300px;">
                    @isset($rev_chart)
                        @foreach($rev_chart as $r)
                        @php
                            $height = ($r->total > 0) ? min(($r->total / 50000) * 100, 100) : 5;
                        @endphp
                        <div class="text-center flex-grow-1 position-relative" style="height: 100%;">
                            <div class="bg-gradient bg-primary rounded-top mx-auto shadow-sm" 
                                 style="width: 50px; height: {{ $height }}%; transition: 1s ease-in-out; background: linear-gradient(to top, #E7B894, #d4a37a) !important;"
                                 data-bs-toggle="tooltip" title="₹{{ number_format($r->total) }}">
                            </div>
                            <div class="small mt-3 text-muted fw-bold">{{ $r->month }}</div>
                            <div class="small text-dark fw-bold">₹{{ number_format($r->total) }}</div>
                        </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
})
</script>
@endsection
