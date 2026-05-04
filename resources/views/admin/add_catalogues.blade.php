@extends('admin.layout.structure')

@section('content')
	  
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Add Catalogue</h1>
              <div class="card">
                <div class="card-body">

			<form action="{{ url('add_catalogues') }}" method="post" enctype="multipart/form-data">
@csrf
    <!-- CATEGORY -->
    <div class="mb-3">
        <label class="form-label">Select Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Select Category --</option>

            <?php foreach($cate_arr as $value) { ?>
                <option value="<?= $value->id ?>">
                    <?= $value->category_name ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <!-- CATALOGUE NAME -->
    <div class="mb-3">
        <label>Catalogue Name</label>
        <input type="text" name="catalogue_name" class="form-control" required>
    </div>

    <!-- DESCRIPTION -->
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <!-- IMAGE -->
    <div class="mb-3">
        <label>Image</label>
        <input type="file"  name="image" class="form-control" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">
        Add Catalogue
    </button>

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

