@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Catalogues (Themes)</h1>
    <a href="add_catalogues" class="btn btn-primary">Add Catalogue</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Category Id</th>
                        <th>Catalogue Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Status</th>
                        
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($catalogue_arr)
                        @foreach($catalogue_arr as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->category_id}}</td>
                            <td class="fw-bold text-start">{{ $value->catalogue_name }}</td>
                            <td>
                                <img width="80px" src="{{ url('upload/catalogues/' . $value->image) }}" class="rounded shadow-sm" alt="{{ $value->catalogue_name }}">
                            </td>
                            <td class="small text-muted text-start" style="max-width: 200px;">{{ Str::limit($value->description, 50) }}</td>
                            <td>
                                <span class="badge bg-{{ $value->status == 'active' ? 'success' : 'danger' }} rounded-pill">
                                    {{ ucfirst($value->status) }}
                                </span>
                            </td>
                            
                            <td class="text-end pe-4">
                                <a href="{{ url('/edit_catalogues/'.$value->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ url('delete_catalogue/' . $value->id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">No catalogues found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
