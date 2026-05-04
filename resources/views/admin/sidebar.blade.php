<?php include_once('header.php'); ?>

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
        <img src="assets/images/image.png" alt="Logo">
        Photography By Monali
    </div>

    <ul><li><a href="dashboard">Dashboard</a></li></ul>
    <ul><li><a href="photographer_management">Photographer Management</a></li></ul>
    <ul><li><a href="client_management">Client Management</a></li></ul>
    <ul><li><a href="gallery_management">Gallery Management</a></li></ul>
    <ul><li><a href="categories_management">Categories Management</a></li></ul>
    <ul><li><a href="package_management">Packages Management</a></li></ul>
    <ul><li><a href="catelogues_management">Catalogues Management</a></li></ul>
    <ul><li><a href="slot_management">Slot Management</a></li></ul>
    <ul><li><a href="appointments_management">Appointments Management</a></li></ul>
    <ul><li><a href="notifications_management">Notifications Management</a></li></ul>
    <ul><li><a href="booking_management">Booking Management</a></li></ul>
    <ul><li><a href="client_album_management">Private Client Gallery</a></li></ul>
    <ul><li><a href="enquiry_management">Enquiries & Inquiries</a></li></ul>
    <ul><li><a href="blog_management">Blog Management</a></li></ul>
    <ul><li><a href="coupon_management">Coupons & Discounts</a></li></ul>
    <ul><li><a href="support_ticket_management">Support Tickets</a></li></ul>

    <ul>
        <li>
            <a onclick="toggleMenu(this)">
                Payment Management
                <span class="arrow">▶</span>
            </a>
            <div class="sub-menu">
                <a href="advance_payment">Advance Payment</a>
                <a href="full_payment">Full Payment</a>
            </div>
        </li>
    </ul>

    <ul><li><a href="reports">Reports</a></li></ul>
    <ul><li><a href="invoice_management">Invoice Management</a></li></ul>
    <ul><li><a href="feedback_management">Feedback Management</a></li></ul>
    
    <div class="mt-4 pt-4 border-top mx-3">
        <a href="logout" class="btn btn-outline-danger w-100 rounded-pill py-2 small fw-bold">
            <i class="fa fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>

</div>
