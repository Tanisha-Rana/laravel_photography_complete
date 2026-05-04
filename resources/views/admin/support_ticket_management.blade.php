@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Support Tickets & Feedback</h1>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th class="text-start">Subject</th>
                        <th class="text-start">Message</th>
                        <th class="text-start">Admin Reply</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($ticket_arr)
                        @foreach($ticket_arr as $value)
                        <tr class="{{ $value->status == 'open' ? 'table-danger' : '' }}">
                            <td>#{{ $value->ticket_id }}</td>
                            <td><strong class="text-primary">{{ $value->client_name }}</strong><br><small class="text-muted">ID: #{{ $value->client_id }}</small></td>
                            <td class="text-start fw-bold">{{ $value->subject }}</td>
                            <td class="text-start small text-muted">{{ $value->message }}</td>
                            <td class="text-start small italic">
                                @if($value->admin_reply)
                                    {{ $value->admin_reply }}
                                @else
                                    <em class="text-danger">Awaiting Response</em>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $value->status == 'open' ? 'danger' : ($value->status == 'replied' ? 'info' : 'success') }} rounded-pill">
                                    {{ ucfirst($value->status) }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ url('admin/reply_ticket?id=' . $value->ticket_id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-reply me-1"></i> Reply
                                </a>
                                <a href="{{ url('admin/delete_ticket/' . $value->ticket_id) }}" 
                                   onclick="return confirm('Note: Deleting will also remove entire history')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No support tickets found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
