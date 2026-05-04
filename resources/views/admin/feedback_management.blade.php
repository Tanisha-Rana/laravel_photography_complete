@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Feedback</h1>
    <span class="badge bg-white text-dark border p-2 shadow-sm rounded-pill px-3">
        Total Reviews: {{ count($feed_arr ?? []) }}
    </span>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Feedback ID</th>
                        <th>Booking ID</th>
                        <th>Client</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feed_arr ?? [] as $feed)
                        <tr>
                            <td class="ps-4">#{{ $feed->feedback_id }}</td>
                            <td>#{{ $feed->booking_id }}</td>
                            <td>{{ $feed->client_name ?? 'N/A' }}</td>
                            <td>
                                @for($i=1;$i<=5;$i++)
                                    <i class="fa fa-star text-{{ $i <= $feed->rating ? 'warning' : 'muted' }} small"></i>
                                @endfor
                            </td>
                            <td>{{ $feed->comment }}</td>
                            <td>{{ date('d M, Y', strtotime($feed->created_at)) }}</td>
                            <td class="text-end pe-4">
                                <a href="#" class="btn btn-sm btn-outline-danger shadow-sm">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No feedback recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
