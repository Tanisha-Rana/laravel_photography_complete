@extends('website.layout.structure')

@section('content')
<div class="container py-5 mt-5">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h1 class="font-dancing-script text-primary">Your Journey With Us</h1>
        <h1 class="display-5 mb-4">My Bookings</h1>
        <p class="mb-0">Track your photography appointments and session status here.</p>
    </div>

    <div class="row g-4 justify-content-center">
        @isset($my_bookings)
            @forelse($my_bookings as $book)
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="text-primary mb-1">📸 {{ $book->category_name }}</h4>
                                <p class="text-muted small mb-3">Themes: <span class="text-dark fw-bold">{{ $book->theme_names ?: 'Standard' }}</span></p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="mb-1 text-muted small">PACKAGE</p>
                                        <h6 class="mb-3">{{ $book->package_name }}</h6>
                                        <p class="mb-1 text-muted small">AMOUNT</p>
                                        <h6 class="mb-0 text-dark">₹{{ $book->total_amount }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-1 text-muted small">DATE & TIME</p>
                                        <h6 class="mb-0 text-dark">{{ date('d M Y', strtotime($book->appointment_date)) }}</h6>
                                        <p class="small text-primary mt-1">{{ $book->slot_name }} ({{ date('h:i A', strtotime($book->start_time)) }} - {{ date('h:i A', strtotime($book->end_time)) }})</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-4 mt-md-0 border-start ps-md-4">
                                <p class="mb-1 text-muted small">BOOKING STATUS</p>
                                @if($book->booking_status == 'pending')
                                    <span class="badge bg-warning text-dark py-2 px-3 rounded-pill mb-2">Pending Review</span>
                                    <p class="small text-muted mt-2 mb-0">Waiting for admin to review your request.</p>
                                    
                                    <!-- CANCEL BUTTON FOR PENDING -->
                                    <div class="mt-4 pt-2 border-top">
                                        <a href="{{ url('cancel_booking?cancel_id=' . $book->booking_id) }}" 
                                           onclick="return confirm('Are you sure you want to cancel this booking?')"
                                           class="text-danger small text-decoration-none fw-bold">
                                           <i class="bi bi-x-circle-fill me-1"></i> Cancel Booking
                                        </a>
                                    </div>
                                @elseif($book->booking_status == 'approved' || $book->booking_status == 'confirm' || $book->booking_status == 'completed')
                                    @if($book->booking_status == 'approved')
                                        <span class="badge bg-info py-2 px-3 rounded-pill text-white mb-2">Approved</span>
                                        <p class="small text-info mt-1 mb-2 fw-bold">Action Required: Pay 20% advance (₹{{ number_format($book->total_amount * 0.20, 2) }}) to confirm your slot.</p>
                                    @elseif($book->booking_status == 'confirm')
                                        <span class="badge bg-success py-2 px-3 rounded-pill text-white mb-2">Confirmed</span>
                                    @else
                                        <span class="badge bg-primary py-2 px-3 rounded-pill text-white mb-2">Completed</span>
                                    @endif
                                    
                                    <div class="mt-3">
                                        <p class="mb-1 text-muted small">PAYMENT STATUS</p>
                                        @if($book->payment_status == 'paid')
                                            <span class="badge bg-info py-2 px-3 rounded-pill text-white">Fully Paid</span>
                                            <p class="small text-success mt-1 mb-2"><i class="bi bi-patch-check"></i> Session secured.</p>
                                            <a href="{{ url('invoice?booking_id=' . $book->booking_id) }}" target="_blank" class="btn btn-outline-dark btn-sm w-100">
                                                <i class="bi bi-file-earmark-pdf"></i> Download Invoice
                                            </a>
                                        @elseif($book->payment_status == 'partial')
                                            <span class="badge bg-primary py-2 px-3 rounded-pill text-white">Partially Paid</span>
                                            <p class="small text-muted mt-1 mb-2">Balance: ₹{{ $book->remaining_amount }}</p>
                                            <a href="{{ url('invoice?booking_id=' . $book->booking_id) }}" target="_blank" class="btn btn-outline-dark btn-sm w-100 mb-2">
                                                <i class="bi bi-file-earmark-pdf"></i> Download Invoice
                                            </a>
                                            <a href="{{ url('payment?booking_id=' . $book->booking_id) }}" class="btn btn-outline-primary btn-sm w-100">Pay Balance</a>
                                        @else
                                            <span class="badge bg-danger py-2 px-3 rounded-pill text-white">Unpaid</span>
                                            <a href="{{ url('payment?booking_id=' . $book->booking_id) }}" class="btn btn-primary btn-sm mt-2 w-100">Proceed to Payment</a>
                                        @endif
                                        
                                        <!-- REVIEW BUTTON -->
                                        @php 
                                            // Check if session date has passed and payment is done
                                        @endphp
                                        @if($book->payment_status == 'paid' && strtotime($book->appointment_date) < time())
                                        <div class="mt-3">
                                            <a href="{{ url('submit-review?booking_id=' . $book->booking_id) }}" class="btn btn-warning btn-sm w-100 fw-bold">
                                                <i class="bi bi-star me-1"></i> Rate Your Session
                                            </a>
                                        </div>
                                        @endif
                                    </div>

                                    @if($book->booking_status != 'completed')
                                    <!-- CANCEL BUTTON FOR ACTIVE BOOKINGS -->
                                    <div class="mt-4 pt-2 border-top">
                                        <a href="{{ url('cancel_booking?cancel_id=' . $book->booking_id) }}" 
                                           onclick="return confirm('Are you sure you want to cancel this booking? Refund policy may apply.')"
                                           class="text-danger small text-decoration-none fw-bold">
                                           <i class="bi bi-x-circle-fill me-1"></i> Cancel Booking
                                        </a>
                                    </div>
                                    @endif

                                @elseif($book->booking_status == 'cancelled')
                                    <span class="badge bg-dark py-2 px-3 rounded-pill text-white mb-2">Cancelled</span>
                                    <p class="small text-muted mt-2 mb-0">This booking has been cancelled.</p>
                                @else
                                    <span class="badge bg-danger py-2 px-3 rounded-pill text-white mb-2">Rejected</span>
                                    <p class="small text-danger mt-2 mb-0">This request was not accepted. Please try another slot.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-6">
                <div class="text-center py-5 bg-white shadow-sm rounded-3">
                    <i class="bi bi-calendar-x text-muted display-1"></i>
                    <h3 class="mt-4">No Bookings Found</h3>
                    <p class="text-muted">You haven't requested any photography appointments yet.</p>
                    <a href="{{ url('categories') }}" class="btn btn-primary px-4 py-2 mt-3">Start Booking Now</a>
                </div>
            </div>
            @endforelse
        @else
            <div class="col-lg-6">
                <div class="text-center py-5 bg-white shadow-sm rounded-3">
                    <i class="bi bi-calendar-x text-muted display-1"></i>
                    <h3 class="mt-4">No Bookings Found</h3>
                    <p class="text-muted">You haven't requested any photography appointments yet.</p>
                    <a href="{{ url('categories') }}" class="btn btn-primary px-4 py-2 mt-3">Start Booking Now</a>
                </div>
            </div>
        @endisset
    </div>
</div>

<style>
.card {
    transition: 0.3s;
    border-radius: 15px;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}
.badge {
    font-weight: 500;
}
</style>
@endsection
