@extends('website.layout.structure')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Edit Profile</h5>
                </div>

                <form method="post" action="{{ url('/edit_profile') }}">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="fw-bold">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Email</label>
                            <input type="email" value="{{ $user->email }}" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Mobile Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control" required>
                        </div>

                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" name="update" class="btn btn-primary px-4">
                            Update Profile
                        </button>

                        <a href="{{ url('profile') }}" class="btn btn-secondary px-4">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
@endsection
