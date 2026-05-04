@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Categories</h1>
    <a href="add_categories" class="btn btn-primary">Add Categories</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                       
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($cate_arr)
                        @foreach($cate_arr as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td class="fw-bold">{{ $value->category_name }}</td>
                            <td>
                                <img width="100px" src="{{ url('upload/categories/' . $value->category_image) }}" class="img-fluid rounded border shadow-sm" alt="{{ $value->category_image }}">
                            </td>
                            <td>
                                <a href="{{url('/status_category/'.$value->id)}}" class="btn {{ $value->status == 'Unblock' ? 'btn-success' : 'btn-danger' }}">
                                    <?php echo $value->status?>
                                </a>
                            </td>
                           
                            <td class="text-end pe-4">
                                <a href="{{url('/edit_categories/'.$value->id)}}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-edit me-1"></i> Edit
                                </a>
                                <a href="{{ url('/delete_category/' . $value->id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No categories found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
