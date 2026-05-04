@extends('photographer.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 text-center">
    <h1 class="h3">Notifications</h1>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4">
    @forelse($notif_arr ?? [] as $notif)
        <div class="alert alert-light border-start border-4 border-primary mb-3 shadow-sm d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="fa fa-bell text-primary"></i>
                </div>
                <div>
                    <h6 class="mb-1 text-dark fw-bold">
                        {{ $notif->title }} 
                        @if($notif->is_read == 'no')
                            <span class="badge bg-primary ms-2 small">New</span>
                        @endif
                    </h6>
                    <p class="mb-0 text-muted small">{{ $notif->message }}</p>
                </div>
            </div>
            <small class="text-muted text-nowrap ms-3">{{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</small>
        </div>
    @empty
        <div class="text-center py-5 text-muted">
            <i class="fa fa-bell-slash fa-3x mb-3"></i>
            <p>No new notifications for you!</p>
        </div>
    @endforelse
</div>
@endsection