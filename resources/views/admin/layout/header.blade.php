


<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>Photography By Monali | Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Base href removed for Laravel -->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>
/* ===============================
   GLOBAL
================================ */
body{
    font-family:'Inter','Poppins',sans-serif;
    background:#f4f6f9;
}

/* ===============================
   SIDEBAR
================================ */
.sidebar{
    width:260px;
    height:100vh;
    background:#ffffff;
    border-right:1px solid #e6e6e6;
    position:fixed;
    left:0;
    top:0;
    overflow-y:auto;
}

.sidebar-brand{
    padding:20px;
    border-bottom:1px solid #ededed;
    font-weight:600;
    font-size:18px;
    color:#222;
}

/* SECTION TITLE */
.menu-title{
    padding:15px 20px 5px;
    font-size:11px;
    text-transform:uppercase;
    color:#9aa0a6;
    letter-spacing:1px;
}

/* MENU */
.sidebar ul{
    list-style:none;
    padding:0;
    margin:0;
}

.sidebar ul li a{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px 20px;
    color:#444;
    font-size:14px;
    text-decoration:none;
    transition:0.3s;
    cursor:pointer;
}

.sidebar ul li a:hover{
    background:#f1f3f6;
    color:#000;
}

.sidebar ul li.active > a{
    background:#eef1f5;
    color:#000;
    font-weight:500;
}

/* ARROW */
.arrow{
    font-size:12px;
    transition:0.3s;
}
.sidebar ul li.active .arrow{
    transform:rotate(90deg);
}

/* SUB MENU */
.sub-menu{
    display:none;
    background:#fafafa;
}

.sub-menu a{
    padding:8px 40px;
    font-size:13px;
    color:#666;
}

.sub-menu a:hover{
    background:#f1f3f6;
    color:#000;
}

/* CONTENT */
.main-content{
    margin-left:260px;
    padding:25px;
}
</style>
</head>
<body>
    @include('sweetalert::alert')
    <script>
    function toggleMenu(el){
        const parent = el.parentElement;
        parent.classList.toggle("active");

        const submenu = parent.querySelector(".sub-menu");
        submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    }
    </script>

<!-- include logic handled by dashboard/layout -->

<style>
    /* ================= SIDEBAR THEME ================= */

/* ICON STYLE */
.sidebar ul li a i{
    width:20px;
    text-align:center;
    margin-right:12px;
    font-size:15px;
    transition:0.3s;
}

/* SIDEBAR */
.sidebar{
    width:260px;
    height:100vh;
    background:#ffffff;
    position:fixed;
    left:0;
    top:0;
    border-right:1px solid #eaeaea;
    box-shadow:4px 0 25px rgba(0,0,0,0.06);
    overflow-y:auto;
    padding-bottom:40px;
}

/* BRAND */
.sidebar-brand{
    display:flex;
    align-items:center;
    gap:12px;
    padding:22px;
    border-bottom:1px solid #f0f0f0;
    font-size:18px;
    font-weight:700;
    color:#222;
}
.sidebar-brand img{
    width:42px;
    height:42px;
    object-fit:contain;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.15);
}

/* MENU */
.sidebar ul{
    list-style:none;
    padding:0;
    margin:10px 0;
}
.sidebar ul li a{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 22px;
    font-size:14px;
    color:#444;
    text-decoration:none;
    transition:0.3s;
    border-radius:12px;
    margin:4px 12px;
}

/* 🔥 HOVER COLOR (IMAGE MATCH) */
.sidebar ul li a:hover{
    background:#E7B894;
    color:#000;
    box-shadow:0 8px 20px rgba(0,0,0,0.12);
}

/* ACTIVE MENU */
.sidebar ul li.active a,
.sidebar ul li a.active{
    background:#E7B894;
    color:#000;
    font-weight:600;
    box-shadow:0 8px 20px rgba(0,0,0,0.12);
}

/* ICON COLOR ON HOVER / ACTIVE */
.sidebar ul li a:hover i,
.sidebar ul li.active a i{
    color:#000;
}

/* SUB MENU */
.sub-menu{
    display:none;
    background:#fdf7f2;
    margin:5px 18px;
    border-radius:12px;
    overflow:hidden;
}
.sub-menu a{
    padding:10px 25px;
    font-size:13px;
    color:#555;
}
.sub-menu a:hover{
    background:#E7B894;
    color:#000;
}

/* ARROW */
.arrow{
    font-size:12px;
    transition:0.3s;
}
li.active .arrow{
    transform:rotate(90deg);
}

</style>
<!-- SIDEBAR -->
<div class="sidebar">

    <div class="sidebar-brand">
        <img src="{{ url('website/img/logo.png') }}" alt="Logo">
        Photography By Monali
    </div>

    <ul><li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ url('dashboard') }}">Dashboard</a></li></ul>
    <ul><li class="{{ Request::is('photographer_management*') ? 'active' : '' }}"><a href="{{ url('photographer_management') }}">Photographer Management</a></li></ul>
    <ul><li class="{{ Request::is('client_management*') ? 'active' : '' }}"><a href="{{ url('client_management') }}">Client Management</a></li></ul>
    <ul><li class="{{ Request::is('categories_management*') ? 'active' : '' }}"><a href="{{ url('categories_management') }}">Categories Management</a></li></ul>
    <ul><li class="{{ Request::is('catelogues_management*') ? 'active' : '' }}"><a href="{{ url('catelogues_management') }}">Catalogues Management</a></li></ul>
    <ul><li class="{{ Request::is('package_management*') ? 'active' : '' }}"><a href="{{ url('package_management') }}">Packages Management</a></li></ul>
    <ul><li class="{{ Request::is('gallery_management*') ? 'active' : '' }}"><a href="{{ url('gallery_management') }}">Gallery Management</a></li></ul>
    <ul><li class="{{ Request::is('slot_management*') ? 'active' : '' }}"><a href="{{ url('slot_management') }}">Slot Management</a></li></ul>
    
    <ul><li class="{{ Request::is('notifications_management*') ? 'active' : '' }}"><a href="{{ url('notifications_management') }}">
        Notifications Management
        
    </a></li></ul>
    <ul><li class="{{ Request::is('booking_management*') ? 'active' : '' }}"><a href="{{ url('booking_management') }}">Booking Management</a></li></ul>

    <ul><li class="{{ Request::is('enquiry_management*') ? 'active' : '' }}"><a href="{{ url('enquiry_management') }}">Enquiry Management</a></li></ul>
    

    <ul>
        <li class="{{ Request::is('advance_payment*') || Request::is('full_payment*') ? 'active' : '' }}">
            <a onclick="toggleMenu(this)">
                Payment Management
                <span class="arrow">▶</span>
            </a>
            <div class="sub-menu" style="display: {{ Request::is('advance_payment*') || Request::is('full_payment*') ? 'block' : 'none' }};">
                <a href="{{ url('advance_payment') }}" class="{{ Request::is('advance_payment*') ? 'active' : '' }}">Advance Payment</a>
                <a href="{{ url('full_payment') }}" class="{{ Request::is('full_payment*') ? 'active' : '' }}">Full Payment</a>
            </div>
        </li>
    </ul>

    <ul><li class="{{ Request::is('reports*') ? 'active' : '' }}"><a href="{{ url('reports') }}">Reports</a></li></ul>
    <ul><li class="{{ Request::is('invoice_management*') ? 'active' : '' }}"><a href="{{ url('invoice_management') }}">Invoice Management</a></li></ul>
    <ul><li class="{{ Request::is('feedback_management*') ? 'active' : '' }}"><a href="{{ url('feedback_management') }}">Feedback Management</a></li></ul>
    
    <div class="mt-4 pt-4 border-top mx-3">
        <a href="{{ url('logout') }}" class="btn btn-outline-danger w-100 rounded-pill py-2 small fw-bold">
            <i class="fa fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>

</div>
