<?php
include ('header.php');
include ('sidebar.php');
?>
	  
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Edit Invoice</h1>
              <div class="card">
                <div class="card-body">

				  <form action="" method="post" class="mt-3" enctype="multipart/form-data">
                     

                        <div class="mb-3">
                        <label class="form-label">Booking_ID</label>
                        <input type="text" name="booking_id" value="<?php echo $fetch->booking_id; ?>" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Invoice Number</label>
                        <input type="text" name="invoice_number" value="<?php echo $fetch->invoice_number; ?>" class="form-control" >
                        </div>


                        <div class="mb-3">
                        <label class="form-label">Invoice Date</label>
                        <input type="text" name="invoice_date" value="<?php echo $fetch->invoice_date; ?>" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Total Amount</label>
                        <input type="text" name="total_amount" value="<?php echo $fetch->total_amount; ?>" class="form-control" >
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

