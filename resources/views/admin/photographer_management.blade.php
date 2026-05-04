@extends('admin.layout.structure')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Photographers</h1>
    <a href="add_photographer" class="btn btn-primary">Add Photographer</a>
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
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                        @foreach($photo_arr as $value)
                    
                        <tr>
                            <td scope="col" class="px-0">{{ $value->id }}</td>
						    <td scope="col" class="px-0">{{ $value->name }}</td>
                            <td scope="col" class="px-0">{{ $value->email }}</td>
                            <td scope="col" class="px-0">{{ $value->phone }}</td>
                            <td scope="col" class="px-0">
                                
                                    {{ $value->status == 'active' ? 'Active' : 'Inactive' }}
                                
                            </td>
                            
                            <td>
                                <a href="{{ url('edit_photographer/' . $value->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-edit me-1"></i> Edit
                                </a>
                                <a href="{{ url('delete_photographer/' . $value->id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
