@extends('photographer.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">My Bookings</h1>
    <span class="badge bg-white text-dark border p-2 shadow-sm rounded-pill px-3">
        Total Bookings: {{ count($book_arr ?? []) }}
    </span>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Client</th>
                        <th>Category</th>
                        <th>Slot / Date</th>
                        <th>Venue</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($book_arr ?? [] as $book)
                        <tr>
                            <td class="ps-4">#{{ $book->booking_id }}</td>
                            <td>{{ $book->client_name }}</td>
                            <td>{{ $book->category_name }}</td>
                            <td>{{ $book->appointment_date }} ({{ $book->slot_name }})</td>
                            <td>{{ $book->venue_type }}</td>
                            <td><span class="badge bg-info rounded-pill">{{ $book->booking_status }}</span></td>
                            <td class="text-end pe-4">
                                <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No bookings found for you.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection