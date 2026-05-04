@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Slots</h1>
    <a href="add_slots" class="btn btn-primary">Add Slot</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Slot Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                       
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($slot_arr)
                        @foreach($slot_arr as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td class="fw-bold">{{ $value->slot_name }}</td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ date('h:i A', strtotime($value->start_time)) }}</span></td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ date('h:i A', strtotime($value->end_time)) }}</span></td>
                            <td>
                                <span class="badge bg-{{ $value->status == 'active' ? 'success' : 'danger' }} rounded-pill">
                                    {{ ucfirst($value->status) }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ url('edit_slots/' . $value->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ url('delete_slot/' . $value->id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No slots found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
