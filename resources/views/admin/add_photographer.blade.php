@extends('admin.layout.structure')

@section('content')
	  
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Add Photographer</h1>
              <div class="card">
                <div class="card-body">

				  <form action="{{ url('add_photographer') }}" method="post" class="mt-3" enctype="multipart/form-data">
            @csrf
                     

                        

                       

                    
                    

                        <div class="mb-3">
                        <label class="form-label">Photographer Name</label>
                        <input type="text" name="name" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Photographer email</label>
                        <input type="text" name="email" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Photographer phone</label>
                        <input type="text" name="phone" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Photographer Password</label>
                        <input type="password" name="password" class="form-control" >
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

