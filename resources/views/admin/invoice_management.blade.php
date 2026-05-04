@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Invoice</h1>
    <a href="{{ url('admin/add_invoice') }}" class="btn btn-primary">Add Invoice</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Invoice ID</th>
                        <th>Booking ID</th>
                        <th>Invoice Number</th>
                        <th>Invoice Date</th>
                        <th>Total Amount</th>
                        <th>Created At</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inv_arr ?? [] as $inv)
                        <tr>
                            <td class="ps-4">#{{ $inv->invoice_id }}</td>
                            <td>#{{ $inv->booking_id }}</td>
                            <td>{{ $inv->invoice_number }}</td>
                            <td>{{ $inv->invoice_date }}</td>
                            <td>₹{{ number_format($inv->total_amount, 2) }}</td>
                            <td>{{ date('d-m-Y', strtotime($inv->created_at)) }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ url('admin/edit_invoice?id=' . $inv->invoice_id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">Edit</a>
                                <a href="{{ url('admin/delete_invoice/' . $inv->invoice_id) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger rounded-pill px-3">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No invoices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
