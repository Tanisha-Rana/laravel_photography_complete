<?php 
include_once ('sidebar.php'); 
include_once ('header.php');
?>

<main class="col-md-10 ms-sm-auto px-4 mt-3">
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3">Create Private Gallery Album</h1>
    <a href="client_album_management" class="btn btn-secondary">Back to List</a>
  </div>
  
  <div class="card shadow border-0 mt-4 rounded-4 p-4">
    <form method="post">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Select Client</label>
                <select name="client_id" class="form-select" required>
                    <option value="">-- Choose Client --</option>
                    <?php foreach($client_arr as $c) { ?>
                        <option value="<?= $c->client_id ?>"><?= $c->name ?> (<?= $c->email ?>)</option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Album Name</label>
                <input type="text" name="album_name" class="form-control" placeholder="e.g. Newborn Session - Baby Kabir" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Gallery Access Password</label>
                <div class="input-group">
                    <input type="text" name="album_password" id="pass_field" class="form-control" placeholder="Create access code" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="generatePass()">Generate</button>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="active">Active (Visible to Client)</option>
                    <option value="inactive">Inactive (Hidden)</option>
                </select>
            </div>

            <div class="col-md-12 mt-4 text-center">
                <button type="submit" name="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm rounded-pill">
                    <i class="bi bi-folder-plus me-1"></i> Create Album Now
                </button>
            </div>
        </div>
    </form>
  </div>
</main>

<script>
function generatePass() {
    let pass = Math.random().toString(36).slice(-8).toUpperCase();
    document.getElementById('pass_field').value = pass;
}
</script>

<script src="./assets/libs/jquery/dist/jquery.min.js"></script>
<script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/sidebarmenu.js"></script>
<script src="./assets/js/app.min.js"></script>
<script src="./assets/libs/simplebar/dist/simplebar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
