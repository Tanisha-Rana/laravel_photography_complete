@extends('website.layout.structure')

@section('content')
<div class="container py-5 mt-5">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h1 class="font-dancing-script text-primary">Stay Updated</h1>
        <h1 class="display-5 mb-4">Notifications</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @if(!empty($notifications) && $notifications->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($notifications as $notif)
                                <div class="list-group-item p-4 {{ $notif->is_read == 'no' ? 'bg-light' : '' }}">
                                    <div class="d-flex align-items-center">
                                        <div class="notif-icon me-3 flex-shrink-0">
                                            <i class="bi bi-bell-fill text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-1">
                                                    @if($notif->is_read == 'no')
                                                        <span class="badge bg-primary me-2">New</span>
                                                    @endif 
                                                    {{ $notif->title ?? 'Update on your Booking' }}
                                                </h6>
                                                <small class="text-muted">{{ date('d M, h:i A', strtotime($notif->created_at)) }}</small>
                                            </div>
                                            <p class="mb-0 text-dark">{{ $notif->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-bell-slash text-muted display-3"></i>
                            <h5 class="mt-3">No Notifications</h5>
                            <p class="text-muted mb-0">You're all caught up!</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ url('mybooking') }}" class="btn btn-outline-primary py-2 px-4">View My Bookings</a>
            </div>
        </div>
    </div>
</div>

<style>
.notif-icon {
    width: 45px;
    height: 45px;
    background: rgba(var(--bs-primary-rgb), 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}
.list-group-item {
    transition: 0.3s;
    border-color: #f1f1f1;
}
.list-group-item:hover {
    background-color: #fafafa !important;
}
</style>
@endsection
