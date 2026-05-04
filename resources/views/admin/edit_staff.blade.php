<?php
include ('header.php');
include ('sidebar.php');
?>
	  
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Edit Staff</h1>
              <div class="card">
                <div class="card-body">

				  <form action="" method="post" class="mt-3" enctype="multipart/form-data">
                     

                        <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="<?php echo $fetch->name; ?>" class="form-control" >
                        </div>

                        

                        <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="<?php echo $fetch->email; ?>" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" value="<?php echo $fetch->phone; ?>" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" name="status" value="<?php echo $fetch->status; ?>" class="form-control" >
                        </div>

                       

                    
                    
                   
					
                   
                    <button type="submit" name="update" class="btn btn-primary">Submit</button>
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

