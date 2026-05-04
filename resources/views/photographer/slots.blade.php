@extends('photographer.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage My Slots</h1>
    <a href="#" class="btn btn-primary rounded-pill px-4">Add Slot</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Slot Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slot_arr ?? [] as $slot)
                        <tr>
                            <td class="ps-4">#{{ $slot->slot_id }}</td>
                            <td>{{ $slot->slot_name }}</td>
                            <td>{{ date('h:i A', strtotime($slot->start_time)) }}</td>
                            <td>{{ date('h:i A', strtotime($slot->end_time)) }}</td>
                            <td><span class="badge bg-{{ $slot->status == 'active' ? 'success' : 'secondary' }} rounded-pill">{{ $slot->status }}</span></td>
                            <td class="text-end pe-4">
                                <a href="#" class="btn btn-sm btn-outline-info">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No slots added.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection