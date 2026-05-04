@extends('admin.layout.structure')

@section('content')
<style>
.badge-pill {
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 600;
}
.client-info {
    display: flex;
    align-items: center;
    gap: 10px;
}
.client-avatar {
    width: 35px;
    height: 35px;
    background: #E7B894;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}
.page-card {
    background: #fff;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: none;
}
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Booking Management</h3>
            <p class="text-muted">Review and manage all photography sessions</p>
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-white text-dark border p-2 shadow-sm rounded-pill px-3">
                Total Bookings: {{ count($book_arr) }}
            </span>
        </div>
    </div>

    <div class="page-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="small text-uppercase">Booking ID</th>
                        <th class="small text-uppercase">Client ID</th>
                        <th class="small text-uppercase">Category ID</th>
                        <th class="small text-uppercase">Package ID</th>
                        <th class="small text-uppercase">Slot ID</th>
                        <th class="small text-uppercase">Appointment Date</th>
                        <th class="small text-uppercase">Venue</th>
                        <th class="small text-uppercase">Total Amount</th>
                        <th class="small text-uppercase">Advance Amount</th>
                        <th class="small text-uppercase">Remaining Amount</th>
                        <th class="small text-uppercase">Booking Status</th>
                        <th class="small text-uppercase">Payment Status</th>
                        <th class="text-end small text-uppercase">Assign Photographer</th>
                        <th class="text-end small text-uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($book_arr)
                        @foreach($book_arr as $data)
                        <tr>
                            <td class="fw-bold text-dark">{{ $data->id }}</td>
                            <td>
                                
                                    
                                        <div class="fw-bold">{{ $data->client_id}}</div>
                                    </td>
                                    <td>

                                
                                    <div class="text-dark fw-bold">{{ $data->category_id }}</div>

                            </td>
                            <td>
                                <small class="text-muted">{{ $data->package_id }}</small>
                                
                            </td>
                            <td>

                                <small class="badge bg-light text-dark border">{{ $data->slot_id }}</small>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $data->appointment_date ? date('d M, Y', strtotime($data->appointment_date)) : 'N/A' }}</div>
                            </td>
                            
                            
                            <td>
                                <span class="badge bg-light text-dark border">{{ ucfirst($data->venue_type) }}</span>
                                <div class="small text-muted mt-1" title="{{ $data->venue_address }}">
                                    {{ $data->venue_address ? Str::limit($data->venue_address, 20) : 'Studio' }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">₹{{ number_format($data->total_amount, 2) }}</div>
                                
                            </td>
                           
                            <td>
                                @if($data->booking_status == 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning badge-pill">Pending</span>
                                @elseif($data->booking_status == 'approved')
                                    <span class="badge bg-info bg-opacity-10 text-info badge-pill">Approved</span>
                                @elseif($data->booking_status == 'confirm')
                                    <span class="badge bg-success bg-opacity-10 text-success badge-pill">Confirmed</span>
                                @elseif($data->booking_status == 'completed')
                                    <span class="badge bg-primary bg-opacity-10 text-primary badge-pill">Completed</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger badge-pill">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge border text-dark bg-light badge-pill">{{ ucfirst($data->payment_status) }}</span>
                            </td>
                            <td>
                                @if(in_array($data->booking_status, ['approved', 'confirm', 'completed']))
                                <form action="{{ url('admin/assign_photographer') }}" method="post" class="d-flex gap-1">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $data->booking_id }}">
                                    <select name="photographer_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">-- Assign --</option>
                                        @foreach($photographer_arr as $p)
                                            <option value="{{ $p->photographer_id }}" {{ ($data->photographer_id == $p->photographer_id) ? 'selected' : '' }}>
                                                {{ $p->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                                @else
                                <span class="small text-muted" style="font-size:11px;"><i class="bi bi-info-circle"></i> Approve to assign</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a class="btn btn-sm btn-info text-white rounded-pill px-3" href="{{ url('admin/manage_status?status=approved&id='.$data->booking_id) }}" title="Approve">
                                        <i class="bi bi-hand-thumbs-up"></i> Approved
                                    </a>
                                    <a class="btn btn-sm btn-success text-white rounded-pill px-3" href="{{ url('admin/manage_status?status=confirm&id='.$data->booking_id) }}" title="Confirm">
                                        <i class="bi bi-check-circle"></i> Confirm
                                    </a>
                                    <a class="btn btn-sm btn-danger text-white rounded-pill px-3" href="{{ url('admin/manage_status?status=cancelled&id='.$data->booking_id) }}" title="Cancel">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </a>
                                    
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light border rounded-pill px-2" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                            <li><a class="dropdown-item" href="{{ url('admin/manage_status?status=pending&id='.$data->booking_id) }}"><i class="bi bi-clock me-2"></i> Set Pending</a></li>
                                            <li><a class="dropdown-item text-primary" href="{{ url('admin/manage_status?status=completed&id='.$data->booking_id) }}"><i class="bi bi-check2-all me-2"></i> Complete</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-success" href="{{ url('admin/generate_invoice/'.$data->booking_id) }}"><i class="bi bi-file-earmark-text me-2"></i> Generate Invoice</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0)" 
                                                onclick="openEditModal({{ $data->booking_id }}, '{{ $data->booking_status }}', '{{ $data->payment_status }}', '{{ (float)($data->extra_charges ?? 0) }}', '{{ addslashes($data->admin_note ?? '') }}')">
                                                <i class="bi bi-pencil me-2"></i> Edit Details</a></li>
                                            <li><a class="dropdown-item text-danger" href="{{ url('admin/delete_booking/'.$data->booking_id) }}" onclick="return confirm('Delete record?')"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">No bookings found in the system.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- EDIT BOOKING MODAL -->
<div class="modal fade" id="editBookingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ url('admin/update_booking_details') }}" method="post">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Update Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="booking_id" id="edit_booking_id">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Booking Status</label>
                            <select name="booking_status" id="edit_booking_status" class="form-select border-0 bg-light shadow-sm">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="confirm">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Payment Status</label>
                            <select name="payment_status" id="edit_payment_status" class="form-select border-0 bg-light shadow-sm">
                                <option value="unpaid">Unpaid</option>
                                <option value="partial">Partial</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Extra Charges (Petrol/Travel)</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text border-0 bg-light">₹</span>
                                <input type="number" name="extra_charges" id="edit_extra_charges" class="form-control border-0 bg-light" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Admin Note (Internal/Rejection Reason)</label>
                            <textarea name="admin_note" id="edit_admin_note" class="form-control border-0 bg-light shadow-sm" rows="3" placeholder="Add specific notes or rejection reason..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(id, b_status, p_status, extra, note) {
    document.getElementById('edit_booking_id').value = id;
    document.getElementById('edit_booking_status').value = b_status;
    document.getElementById('edit_payment_status').value = p_status;
    document.getElementById('edit_extra_charges').value = extra;
    document.getElementById('edit_admin_note').value = note;
    
    let modalEl = document.getElementById('editBookingModal');
    let modal = new bootstrap.Modal(modalEl);
    modal.show();
}
</script>
@endsection
