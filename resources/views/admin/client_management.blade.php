@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Client Management</h1>
    
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="" method="POST">
    @csrf


<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Info</th>
                        <th>Status</th>
                        
                
                        
                        
                    </tr>
                </thead>
                <tbody>
                    
                        @foreach($client_arr as $value)
                        <tr>
                            <td class="ps-4">{{ $value->id }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $value->name }}</div>
                            </td>
                            <td>
                                <div class="small text-muted"><i class="fa fa-envelope me-1"></i> {{ $value->email }}</div>
                            </td>
                            <td>
                                <div class="small text-muted"><i class="fa fa-phone me-1"></i> {{ $value->phone }}</div>
                            </td>

                            <td>
                                <div class="small text-muted"> {{ $value->status }}</div>
                            </td>
                            
                            
                            
                        @endforeach
                    
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
