@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Editor Management</h1>
    <a href="add_editor" class="btn btn-primary">Add New Editor</a>
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
                        
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($editor_arr ?? [] as $editor)
                        <tr>
                            <td class="ps-4">{{ $editor->id }}</td>
                            <td class="fw-bold">{{ $editor->name }}</td>
                            <td>{{ $editor->email }}</td>
                            <td>{{ $editor->phone }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ url('edit_editor/' . $editor->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-edit me-1"></i> Edit
                                </a>
                                <a href="{{ url('admin/delete_editor/' . $editor->id) }}" 
                                   onclick="return confirm('Are you sure you want to delete this editor?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No editors registered yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
