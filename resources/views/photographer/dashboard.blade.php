@extends('photographer.layout.structure')

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
.icon-booking{background:#fd7e14;}
.icon-gallery{background:#0d6efd;}
.icon-notification{background:#ffc107;}

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
    <h3 class="mb-1">Photographer Dashboard</h3>
    <p class="text-muted mb-4">Photography By Monali – Photographer Panel</p>

    <div class="row g-4">
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon icon-booking">
                <i class="fa fa-camera"></i>
            </div>
            <h6>My Bookings</h6>
            <h2>{{ $stats['total_bookings'] ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon icon-gallery">
                <i class="fa fa-image"></i>
            </div>
            <h6>My Gallery</h6>
            <h2>{{ $stats['total_gallery'] ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon icon-notification">
                <i class="fa fa-bell"></i>
            </div>
            <h6>Notifications</h6>
            <h2>{{ $stats['total_notifications'] ?? 0 }}</h2>
        </div>
    </div>
</div>

    <div class="mt-5 dashboard-card">
        <h5>Welcome Photographer 👋</h5>
        <p class="mb-0 text-muted">
            Manage your bookings and gallery items here.
        </p>
    </div>

</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection