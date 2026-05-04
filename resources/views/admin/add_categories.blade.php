@extends('admin.layout.structure')

@section('content')
	  
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Add Category</h1>
              <div class="card">
                <div class="card-body">

				  <form action="{{ url('add_categories') }}" method="post" class="mt-3" enctype="multipart/form-data">
                @csrf     

                        <div class="mb-3">
                        <label class="form-label">Category Name</label>
                           <input type="text" name="category_name" class="form-control" >
                        <label class="form-label mt-3">Category Image</label>
                        <input type="file" name="category_image" class="form-control" >
                        </div>

                       

                    
                    
                   
					
                   
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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

