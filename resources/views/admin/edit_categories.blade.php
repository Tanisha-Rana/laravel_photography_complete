@extends('admin.layout.structure')

@section('content')
	  
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Edit Category</h1>
              <div class="card">
                <div class="card-body">

				  <form action="{{ url('edit_categories/'.$data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Category Name</label>
        <input type="text" name="category_name" value="{{ $data->category_name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Current Image:</label><br>
        <img src="{{ url('upload/categories/'.$data->category_image) }}" width="100">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <input type="text" name="status" value="{{ $data->status }}" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
                  
                
				
				</div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>

@endsection

