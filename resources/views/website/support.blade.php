@extends('website.layout.structure')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">Submit Support Ticket</h5>
                <form method="post" action="{{ url('/support') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="e.g. Booking Issue" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Detailed Message</label>
                        <textarea name="message" class="form-control" rows="4" required placeholder="Describe your issue..."></textarea>
                    </div>
                    <button type="submit" name="submit_ticket" class="btn btn-primary w-100 py-2 rounded-pill">Submit Ticket</button>
                </form>
            </div>
            
            <div class="bg-light p-4 rounded-4 border">
                <h6 class="fw-bold"><i class="bi bi-info-circle me-2"></i> FAQ Section</h6>
                <div class="accordion accordion-flush mt-3" id="faqAccordion">
                    <div class="accordion-item bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent py-2 px-0 small fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#f1">
                                How to reschedule my session?
                            </button>
                        </h2>
                        <div id="f1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-0 pt-0 small text-muted">
                                You can reschedule via support ticket or call us 48 hours before the session.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <h4 class="fw-bold mb-4">My Support Tickets</h4>
            <div class="table-responsive">
                <table class="table table-hover border">
                    <thead class="bg-light">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Admin Reply</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($ticket_arr)
                            @forelse($ticket_arr as $t)
                            <tr>
                                <td>#{{ $t->ticket_id }}</td>
                                <td>{{ $t->subject }}</td>
                                <td>
                                    <span class="badge bg-{{ ($t->status == 'open') ? 'danger' : (($t->status == 'replied') ? 'info' : 'success') }}">
                                        {{ ucfirst($t->status) }}
                                    </span>
                                </td>
                                <td class="small text-muted">{{ $t->admin_reply ?: 'Waiting...' }}</td>
                                <td class="small">{{ date('d-m-Y', strtotime($t->created_at)) }}</td>
                            </tr>
                            @empty
                                <tr><td colspan="5" class="text-center py-4 text-muted">No tickets found.</td></tr>
                            @endforelse
                        @else
                            <tr><td colspan="5" class="text-center py-4 text-muted">No tickets found.</td></tr>
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
