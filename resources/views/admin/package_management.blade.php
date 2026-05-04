@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Packages</h1>
    <a href="add_packages" class="btn btn-primary">Add Package</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 text-start">ID</th>
                        <th class="text-start">Category ID</th>
                        <th class="text-start">Package Name</th>
                        <th>Price</th>
                        <th>Max Themes</th>
                        <th>Description</th>
                        
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($pack_arr)
                        @foreach($pack_arr as $value)
                        <tr>
                            <td class="ps-4 text-start">{{ $value->id }}</td>
                            <td class="text-start fw-bold">{{ $value->category_id }}</td>
                            <td class="text-start fw-bold">{{ $value->package_name }}</td>
                            <td>₹{{ number_format($value->price, 0) }}</td>
                            <td>{{ $value->max_catelogues }}</td>
                            <td class="text-muted small" style="max-width: 250px;">{{ Str::limit($value->description, 255) }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ url('/edit_packages/' . $value->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-edit me-1"></i> Edit
                                </a>
                                <a href="{{ url('/delete_packages/' . $value->id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No packages found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
