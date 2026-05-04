<?php
include ('header.php');
include ('sidebar.php');
?>
	  
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Add Notification</h1>
              <div class="card">
                <div class="card-body">

				  <form action="" method="post" class="mt-3" enctype="multipart/form-data">
                     

                        <div class="mb-3">
          <select class="form-control" name="client_id">
										<option value="">Select Client</option>
										<?php
										foreach($client_arr as $data)
										{
										?>
											<option value="<?php echo $data->client_id?>">
															<?php echo $data->name?>
											</option>
										<?php
										}
										?>
									</select>
                  </div>

                        <div class="mb-3">
                        <label class="form-label">Message</label>
                        <input type="text" name="message" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Is Read</label>
                        <input type="text" name="is_read" class="form-control" >
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

