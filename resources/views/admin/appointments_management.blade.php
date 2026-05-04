@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Appointments History</h1>
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
                        <th>Appointment Date</th>
                        <th>Slot</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($appo_arr)
                        @foreach($appo_arr as $value)
                        <tr>
                            <td class="ps-4">#{{ $value->appointment_id }}</td>
                            <td class="fw-bold">{{ $value->client_name }}</td>
                            <td><div class="fw-bold">{{ date('d M, Y', strtotime($value->appointment_date)) }}</div></td>
                            <td><span class="badge bg-light text-dark border">{{ $value->slot_name }}</span></td>
                            <td>
                                <span class="badge bg-{{ $value->status == 'active' ? 'success' : 'danger' }} rounded-pill">
                                    {{ ucfirst($value->status) }}
                                </span>
                            </td>
                            <td class="small">{{ date('d-m-Y H:i', strtotime($value->created_at)) }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ url('admin/delete_appointment/' . $value->appointment_id) }}" 
                                   onclick="return confirm('Delete record?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No appointments found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
