@extends('admin.layout.structure')
@section('content')

<main class="col-md-10 ms-sm-auto px-4">

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">

                <h3 class="mb-3">Add Package</h3>

                <form method="post" action="{{ url('/add_packages') }}" enctype="multipart/form-data">
                    @csrf
  <div class="mb-3">
        <label class="form-label">Select Category</label>
        <select name="category_id" class="form-control" required>
    <option value="">-- Select Category --</option>

    @foreach($cate_arr as $cat)
        <option value="{{ $cat->id }}">
            {{ $cat->category_name }}
        </option>
    @endforeach

</select>    
</div>

                    <div class="mb-3">
                        <label class="form-label">Package Name</label>
                        <input type="text" name="package_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Maximum Catalogues</label>
                        <input type="number" name="max_catelogues" class="form-control" placeholder="e.g. 3">
                    </div>

                   

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">
                        Add Package
                    </button>

                    <a href="package_management" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>
        </div>
    </div>

</main>
