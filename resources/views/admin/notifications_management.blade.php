@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">System Notifications</h1>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Client ID</th>
                        <th>Title & Message</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($notif_arr)
                        @foreach($notif_arr as $value)
                        <tr class="{{ $value->is_read == 'no' ? 'bg-light' : '' }}">
                            <td class="ps-4">{{ $value->id }}</td>
                            <td>
                                {{ $value->client_id }}
                            </td>
                            <td style="max-width: 400px;">
                                <div class="fw-bold">{{ $value->title ?? 'Notification' }}</div>
                                <div class="small text-muted text-truncate">{{ $value->message }}</div>
                            </td>
                            <td>{{ date('d-m-Y H:i', strtotime($value->created_at)) }}</td>
                            <td>
                                @if($value->is_read == 'no')
                                    <span class="badge bg-warning text-dark rounded-pill">Unread</span>
                                @else
                                    <span class="badge bg-success rounded-pill">Read</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                @if($value->url)
                                <a href="{{ url($value->url) }}" class="btn btn-sm btn-outline-info rounded-pill px-3 me-2" title="View Detail">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @endif
                                <a href="{{ url('admin/delete_notification/' . $value->id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No notifications found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
