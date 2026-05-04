<?php 
include_once ('sidebar.php'); 
include_once ('header.php');
?>

<main class="col-md-10 ms-sm-auto px-4 mt-3 pb-5">
  <div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-0">Upload Album Photos</h1>
        <p class="text-muted small">Album: <span class="fw-bold text-primary"><?= $fetch->album_name ?></span> (Client: <?= $client_data->name ?>)</p>
    </div>
    <a href="client_album_management" class="btn btn-secondary">Back to Gallery</a>
  </div>
  
  <div class="card shadow border-0 mt-4 rounded-4 p-4 overflow-hidden">
    <!-- UPLOAD FORM -->
    <form method="post" enctype="multipart/form-data">
        <div class="bg-light p-4 rounded-4 border-2 border-dashed text-center">
            <i class="bi bi-cloud-upload display-4 text-primary"></i>
            <h5 class="fw-bold mt-2">Select Multiple JPG/PNG Photos</h5>
            <p class="text-muted small">You can select 20+ images at once. Recommended size under 2MB each.</p>
            <input type="file" name="album_images[]" class="form-control mt-3" multiple required accept="image/*">
            <button type="submit" name="upload" class="btn btn-primary mt-4 px-5 py-2 fw-bold shadow-sm rounded-pill">
                <i class="bi bi-upload me-1"></i> Start Uploading
            </button>
        </div>
    </form>

    <hr class="my-5">

    <!-- PREVIEW OF UPLOADED IMAGES -->
    <h5 class="fw-bold mb-4">Uploaded Images (<?= count($photos_arr) ?>)</h5>
    <div class="row g-3">
        <?php foreach($photos_arr as $img) { ?>
        <div class="col-md-2 col-6">
            <div class="card h-100 border-0 shadow-sm rounded-3 position-relative overflow-hidden theme-card">
                <img src="assets/images/albums/<?= $img->image ?>" class="card-img-top" style="height: 140px; object-fit: cover;">
                <div class="card-body p-2 text-center">
                    <a href="delete?del_album_img=<?= $img->image_id ?>&album_id=<?= $img->album_id ?>" class="text-danger small fw-bold text-decoration-none" onclick="return confirm('Delete photo?')">
                        <i class="bi bi-trash me-1"></i> Delete
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(empty($photos_arr)) { ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted italic">No images uploaded for this album yet.</p>
            </div>
        <?php } ?>
    </div>
  </div>
</main>

<style>
.border-dashed { border: 2px dashed #dee2e6 !important; }
.theme-card:hover { transform: translateY(-5px); transition: 0.3s; }
</style>

<script src="./assets/libs/jquery/dist/jquery.min.js"></script>
<script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/sidebarmenu.js"></script>
<script src="./assets/js/app.min.js"></script>
<script src="./assets/libs/simplebar/dist/simplebar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
