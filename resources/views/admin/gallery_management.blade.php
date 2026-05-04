@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Gallery</h1>
    <a href="add_gallery" class="btn btn-primary">Add Gallery</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Catalogue</th>
                        <th>Images</th>
                        <th class="text-end pe-4">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @isset($gallery_arr)
                        @foreach($gallery_arr as $value)
                        <tr>
                           <td>{{ $value->id }}</td>

                            <td>{{ $value->catalogue->catalogue_name ?? 'N/A' }}</td>

                            <td>
                                @php 
                                    $decoded = json_decode($value->image, true); 
                                    $images = is_array($decoded) ? $decoded : [$value->image];
                                @endphp
                                @foreach($images as $img)
                                    @if($img)
                                        <img width="60px" 
                                            src="{{ url('upload/gallery/'.$img) }}" 
                                            class="img-fluid rounded border shadow-sm mb-1 me-1">
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ url('/edit_gallery/'.$value->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ url('/delete_gallery/'.$value->id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No gallery items found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
