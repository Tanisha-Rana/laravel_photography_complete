@extends('website.layout.structure')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">My Profile</h5>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold">Full Name</label>
                        <div class="form-control bg-light">
                            {{ $user->name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Email Address</label>
                        <div class="form-control bg-light">
                            {{ $user->email ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Mobile Number</label>
                        <div class="form-control bg-light">
                            {{ $user->phone ?? 'N/A' }}
                        </div>
                    </div>

                </div>

                <div class="card-footer text-center">
                    <a href="{{ url('edit_profile') }}" class="btn btn-primary px-4">
                       Edit profile
                    </a>
                     <a href="{{ url('/') }}" class="btn btn-primary px-4">
                        Back to Home
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
