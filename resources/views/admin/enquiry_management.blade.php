@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Enquiries</h1>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @isset($enquiry_arr)
                        @foreach($enquiry_arr as $data)
                        <tr>
                            <td class="ps-4">{{ $data->id }}</td>
                            <td><strong>{{ $data->name }}</strong></td>
                            <td class="text-start small">
                                <i class="fa fa-envelope me-1"></i> {{ $data->email }}<br>
                            </td>
                            <td>{{ $data->subject }}</td>
                            <td class="text-start small text-muted" title="{{ $data->message }}">{{ Str::limit($data->message, 50) }}</td>
                            <td>
                                <span class="badge bg-{{ $data->status == 'new' ? 'danger' : ($data->status == 'responded' ? 'info' : 'success') }} rounded-pill">
                                    {{ ucfirst($data->status) }}
                                </span>
                            </td>
                            
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">No enquiries found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
