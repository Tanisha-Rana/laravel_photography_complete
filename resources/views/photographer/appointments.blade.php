@extends('photographer.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">My Appointments</h1>
    <span class="badge bg-white text-dark border p-2 shadow-sm rounded-pill px-3">
        Total Sessions: {{ count($appo_arr ?? []) }}
    </span>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Client Name</th>
                        <th>Date</th>
                        <th>Slot</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appo_arr ?? [] as $appo)
                        <tr>
                            <td class="ps-4">#{{ $appo->appointment_id }}</td>
                            <td>{{ $appo->client_name }}</td>
                            <td>{{ $appo->appointment_date }}</td>
                            <td>{{ $appo->slot->slot_name ?? 'N/A' }}</td>
                            <td><span class="badge bg-{{ $appo->status == 'active' ? 'success' : 'secondary' }} rounded-pill">{{ $appo->status }}</span></td>
                            <td class="text-end pe-4">
                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No appointments assigned to you yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection