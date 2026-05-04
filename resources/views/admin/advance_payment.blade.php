@extends('admin.layout.structure')

@section('content')




  

	  
	  
	  
	  
<main class="col-md-10 ms-sm-auto px-4">
  <div class="d-flex justify-content-between align-items-center mt-3">
    <h1 class="h3">Manage Advance Payment</h1>
	
  </div>
				  <div class="table-responsive mt-3">
				<table class="table table-bordered text-center">
					        <thead>
								<tr style="text-align:center">
									<th>Advance Payment ID</th>
									<th>Booking ID</th>
									<th>Advance Amount</th>
									<th>Payment Mode</th>
									<th>Payment Status</th>
									<th> Payment Date  </th>
								</tr>
							</thead>

					  
					  <tbody>
					  
					  <?php
					  foreach($adv_arr as $value)
					  {
					  ?>
					  
						<tr style="text-align:center">
						  <td scope="col" class="px-0"><?php echo $value->advance_payment_id?></td>

						  
						  <td scope="col" class="px-0"><?php echo $value->booking_id?></td>
						  
						  

						  <td scope="col" class="px-0">
							<?php echo $value->advance_amount?>
						  </td>

						  <td scope="col" class="px-0">
							<?php echo $value->payment_mode?>
						  </td>

						  
						  <td scope="col" class="px-0">
							<?php echo $value->payment_status?>
						  </td>

						  <td scope="col" class="px-0">
							<?php echo $value->payment_date?>	
							</td>
	
						 
						</tr>
					<?php
					  }
					?>	
					  </tbody>
					</table>
				  </div>
				
	  
	   </div>
 </div>
					</main>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

@endsection

