@extends('admin.layout.structure')

@section('content')
<style>
/* ===== DASHBOARD THEME ===== */
.main-content{
    padding:30px;
    background:#f8f9fb;
    min-height:100vh;
}

/* Heading */
.main-content h3{
    font-size:28px;
    font-weight:700;
    color:#222;
}
.main-content p{
    color:#6c757d;
    font-size:15px;
}

/* ===== STAT CARDS ===== */
.dashboard-card{
    background:#ffffff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    transition:0.4s;
    position:relative;
    overflow:hidden;
}

.dashboard-card::before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:6px;
    background:linear-gradient(90deg,#ff6f61,#f7b731);
}

.dashboard-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 40px rgba(0,0,0,0.15);
}

/* Icon */
.dashboard-icon{
    width:55px;
    height:55px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    color:#fff;
    margin-bottom:15px;
}

/* Icon Colors */
.icon-client{background:#6f42c1;}
.icon-booking{background:#fd7e14;}
.icon-package{background:#20c997;}
.icon-gallery{background:#0d6efd;}
.icon-enquiry{background:#ffc107;}
.icon-ticket{background:#dc3545;}
.icon-coupon{background:#6610f2;}
.icon-revenue{background:#198754;}

/* Numbers */
.dashboard-card h2{
    font-size:34px;
    font-weight:800;
    color:#222;
    margin:5px 0;
}

/* Label */
.dashboard-card h6{
    text-transform:uppercase;
    font-size:12px;
    letter-spacing:1px;
    color:#6c757d;
}
</style>

<div class="container-fluid">
    <h3 class="mb-1">Dashboard</h3>
    <p class="text-muted mb-4">Photography By Monali – Admin Panel</p>

   <div class="row g-4">
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon icon-revenue">
                <i class="fa fa-indian-rupee-sign"></i>
            </div>
            <h6>Total Revenue</h6>
            <h2>₹{{ number_format($stats['total_revenue'] ?? 0, 0) }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon icon-client">
                <i class="fa fa-users"></i>
            </div>
            <h6>Total Clients</h6>
            <h2>{{ $stats['total_clients'] ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon icon-booking">
                <i class="fa fa-calendar-check"></i>
            </div>
            <h6>Total Bookings</h6>
            <h2>{{ $stats['total_bookings'] ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon icon-enquiry">
                <i class="fa fa-envelope-open"></i>
            </div>
            <h6>Total Enquiries</h6>
            <h2>{{ $stats['total_enquiries'] ?? 0 }}</h2>
        </div>
    </div>


    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon icon-package">
                <i class="fa fa-box"></i>
            </div>
            <h6>Total Packages</h6>
            <h2>{{ $stats['total_packages'] ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon icon-gallery">
                <i class="fa fa-image"></i>
            </div>
            <h6>Gallery Images</h6>
            <h2>{{ $stats['total_gallery'] ?? 0 }}</h2>
        </div>
    </div>

    <!-- REVENUE SUMMARY CARD -->
    <div class="col-md-12 mt-4">
        <div class="dashboard-card" style="background: linear-gradient(135deg, #E7B894 0%, #d4a37a 100%); border: none;">
            <div class="row align-items-center">
                <div class="col-md-8 text-white">
                    <h5 class="mb-1" style="opacity: 0.9;">Business Insights</h5>
                    <h2 class="text-white mb-2">Detailed Reports & Analytics Ready</h2>
                    <p class="text-white mb-0" style="opacity: 0.8;">Track your revenue, booking trends, and performance metrics.</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ url('/reports') }}" class="btn btn-light rounded-pill px-4 fw-bold">View Full Reports</a>
                </div>
            </div>
        </div>
    </div>

</div>

    <!-- OPTIONAL MESSAGE -->
    <div class="mt-5 dashboard-card">
        <h5>Welcome Admin 👋</h5>
        <p class="mb-0 text-muted">
            Manage bookings, clients, packages and gallery from one place.
        </p>
    </div>

</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection
