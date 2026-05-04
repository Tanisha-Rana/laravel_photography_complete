<?php
include ('header.php');
include ('sidebar.php');
?>
	  
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Add Invoice</h1>
              <div class="card">
                <div class="card-body">

				  <form action="" method="post" class="mt-3" enctype="multipart/form-data">
                     

                        <div class="mb-3">
                                <select class="form-control" name="booking_id">
										<option value="">Select Booking Id</option>
										<?php
										foreach($book_arr as $data)
										{
										?>
											<option value="<?php echo $data->booking_id?>">
															<?php echo $data->booking_id?>
											</option>
										<?php
										}
										?>
								</select>
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Invoice Number</label>
                        <input type="text" name="invoice_number" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Invoice Date</label>
                        <input type="text" name="invoice_date" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Total Amount</label>
                        <input type="text" name="total_amount" class="form-control" >
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

